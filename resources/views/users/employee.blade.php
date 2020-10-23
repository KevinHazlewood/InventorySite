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
	<?php 
		$user = Auth::user();
		$store = DB::table('stores')->find($user->storeId);
	?>
	<br/>
	<h4>You are currently an employee at {{ $store->storeName }} </h4>
	<a href="/inventory"><p>Go To Store Inventory Page</p></a>
	</section>
@endsection('content')