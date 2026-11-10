<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EnquiryController extends Controller
{
    private function filtered(Request $request)
    {
        $q = Enquiry::query()->latest();
        if ($s = $request->query('status')) {
            $q->where('status', $s);
        }
        if ($c = $request->query('country')) {
            $q->where('country', $c);
        }
        if ($t = trim((string) $request->query('q'))) {
            $q->where(fn ($w) => $w->where('name', 'like', "%$t%")->orWhere('email', 'like', "%$t%")->orWhere('message', 'like', "%$t%"));
        }

        return $q;
    }

    public function index(Request $request)
    {
        $enquiries = $this->filtered($request)->paginate(25)->withQueryString();
        // Works on MongoDB and SQL alike
        $counts = collect(array_keys(Enquiry::STATUSES))->mapWithKeys(fn ($s) => [$s => Enquiry::where('status', $s)->count()]);

        return view('admin.enquiries', compact('enquiries', 'counts'));
    }

    public function show(Enquiry $enquiry)
    {
        return view('admin.enquiry', compact('enquiry'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Enquiry::STATUSES))],
            'notes'  => ['nullable', 'string', 'max:5000'],
        ]);
        $enquiry->update($data);

        return back()->with('ok', 'Saved');
    }

    public function export(Request $request): StreamedResponse
    {
        $rows = $this->filtered($request)->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel shows ৳ correctly
            fputcsv($out, ['ID', 'Date (Dhaka)', 'Name', 'Email', 'Phone', 'Country', 'Service', 'Budget', 'Status', 'Email verified', 'Message', 'Notes']);
            foreach ($rows as $e) {
                // Prefix cells that start with = + - @ so spreadsheets don't run them as formulas
                $safe = fn ($v) => preg_match('/^[=+\-@\t\r]/', (string) $v) ? "'" . $v : $v;
                fputcsv($out, array_map($safe, [
                    $e->id, $e->created_at->timezone('Asia/Dhaka')->format('Y-m-d H:i'), $e->name, $e->email, $e->phone,
                    $e->country, $e->service, $e->budget, $e->status, $e->verified_at ? 'Yes' : ($e->service === 'AI chat' ? 'No' : ''), $e->message, $e->notes,
                ]));
            }
            fclose($out);
        }, 'enquiries-' . now()->format('Y-m-d') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
