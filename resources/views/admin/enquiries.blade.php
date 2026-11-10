@extends('admin.layout')
@section('content')
<h1>Enquiries</h1>
@php $cur = request('status'); $total = $counts->sum(); @endphp
<div class="pills">
  <a href="{{ route('admin.enquiries', request()->except('status','page')) }}" @class(['on' => !$cur])>All <small>{{ $total }}</small></a>
  @foreach (\App\Models\Enquiry::STATUSES as $k => $label)
    <a href="{{ route('admin.enquiries', array_merge(request()->except('page'), ['status' => $k])) }}" @class(['on' => $cur === $k])>{{ $label }} <small>{{ $counts[$k] ?? 0 }}</small></a>
  @endforeach
</div>
<form class="bar" method="GET">
  @if($cur)<input type="hidden" name="status" value="{{ $cur }}">@endif
  <input type="search" name="q" value="{{ request('q') }}" placeholder="Search name, email or message">
  <select name="country"><option value="">All countries</option>@foreach (\App\Models\Enquiry::COUNTRIES as $c)<option @selected(request('country')===$c)>{{ $c }}</option>@endforeach</select>
  <button class="btn">Filter</button>
  <a class="btn pri" href="{{ route('admin.enquiries.export', request()->query()) }}">Download CSV</a>
</form>
<table>
  <thead><tr><th>Date</th><th>Name</th><th class="hide-m">Country</th><th class="hide-m">Service</th><th class="hide-m">Budget</th><th>Status</th></tr></thead>
  <tbody>
  @forelse ($enquiries as $e)
    <tr onclick="location='{{ route('admin.enquiries.show', $e) }}'" style="cursor:pointer">
      <td class="muted">{{ $e->created_at->timezone('Asia/Dhaka')->format('d M, H:i') }}</td>
      <td><a href="{{ route('admin.enquiries.show', $e) }}"><b>{{ $e->name }}</b></a>@if($e->service === 'AI chat') <span class="tag">AI chat</span>@endif @if($e->verified_at)<span class="tag ok" title="Email confirmed with a code">✓ Verified</span>@elseif($e->service === 'AI chat')<span class="tag warn">Unverified</span>@endif<br><span class="muted">{{ $e->email }}</span></td>
      <td class="hide-m">{{ $e->country ?? '—' }}</td>
      <td class="hide-m">{{ $e->service ?? '—' }}</td>
      <td class="hide-m">{{ $e->budget ?? '—' }}</td>
      <td><span class="st st-{{ $e->status }}">{{ \App\Models\Enquiry::STATUSES[$e->status] ?? $e->status }}</span></td>
    </tr>
  @empty
    <tr><td colspan="6" class="muted">No enquiries yet.</td></tr>
  @endforelse
  </tbody>
</table>
{{ $enquiries->links() }}
@endsection
