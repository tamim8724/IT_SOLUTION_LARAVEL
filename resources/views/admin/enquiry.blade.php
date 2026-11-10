@extends('admin.layout')
@section('title', $enquiry->name)
@section('content')
<p style="margin-bottom:14px"><a href="{{ route('admin.enquiries') }}" class="muted">← All enquiries</a></p>
<h1>{{ $enquiry->name }}</h1>
@if (session('ok'))<div class="ok">{{ session('ok') }}</div>@endif
<div class="grid">
  <div class="card">
    <dl>
      <div><dt>Email</dt><dd><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a> @if($enquiry->verified_at)<span class="tag ok">✓ Verified {{ $enquiry->verified_at->timezone('Asia/Dhaka')->format('d M, H:i') }}</span>@elseif($enquiry->service === 'AI chat')<span class="tag warn">Unverified</span>@endif</dd></div>
      <div><dt>Phone</dt><dd>{{ $enquiry->phone ?? '—' }}</dd></div>
      <div><dt>Country</dt><dd>{{ $enquiry->country ?? '—' }}</dd></div>
      <div><dt>Service</dt><dd>{{ $enquiry->service ?? '—' }}</dd></div>
      <div><dt>Budget</dt><dd>{{ $enquiry->budget ?? '—' }}</dd></div>
      <div><dt>Received</dt><dd>{{ $enquiry->created_at->timezone('Asia/Dhaka')->format('d M Y, H:i') }} (Dhaka)</dd></div>
    </dl>
    <h3 style="margin:18px 0 8px">Message</h3>
    <p style="white-space:pre-wrap">{{ $enquiry->message }}</p>
  </div>
  <form class="card" method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}">
    @csrf @method('PATCH')
    <p style="margin-bottom:12px"><label>Status<br>
      <select name="status" style="width:100%">@foreach (\App\Models\Enquiry::STATUSES as $k => $l)<option value="{{ $k }}" @selected($enquiry->status===$k)>{{ $l }}</option>@endforeach</select></label></p>
    <p style="margin-bottom:12px"><label>Private notes<br><textarea name="notes" rows="6">{{ old('notes', $enquiry->notes) }}</textarea></label></p>
    <button class="btn pri">Save</button>
    @if($enquiry->phone)<p style="margin-top:14px"><a class="btn" href="https://wa.me/{{ preg_replace('/\D/', '', $enquiry->phone) }}" target="_blank" rel="noopener">WhatsApp</a></p>@endif
  </form>
</div>
@endsection
