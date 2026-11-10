@extends('admin.layout')
@section('title', 'Log in')
@section('content')
<div class="card" style="max-width:400px;margin:10vh auto">
  <h1>Admin log in</h1>
  <form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <p style="margin-bottom:12px"><label>Email<br><input type="email" name="email" value="{{ old('email') }}" required autofocus style="width:100%"></label></p>
    <p style="margin-bottom:12px"><label>Password<br><input type="password" name="password" required style="width:100%"></label></p>
    @error('email')<p class="err">{{ $message }}</p>@enderror
    <p style="margin:12px 0"><label><input type="checkbox" name="remember" style="height:auto"> Remember me</label></p>
    <button class="btn pri" style="width:100%;justify-content:center">Log in</button>
  </form>
</div>
@endsection
