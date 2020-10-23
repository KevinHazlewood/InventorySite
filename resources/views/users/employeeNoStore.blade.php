@extends('layouts.master')
@section('content')
<section class="section">
<h1 class="title">Employee User Page</h1>
	<p class="is-size-4">User Info</p>
	@if(Auth::check())
		<h1>{{Auth::user()->firstName}} {{Auth::user()->lastName}}</h1>
		<h2>User ID: {{Auth::user()->id}}</h2>
		<h2>Email Address: {{Auth::user()->email}}</h2>
	@endif
<br/>
<h3>You are not currently added as an employee at any store</h3>
</section>
@endsection('content')