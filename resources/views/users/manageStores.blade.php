@extends('layouts.master')
@section('content')
<section class="section">
<h1 class="title">Admin Page</h1>
<h3 class="is-size-4">Manage Currently Active Stores</h3>
<div class="owner">
@foreach($stores as $store)
	<div class="columns">
			<div class="column">{{$store->storeName}}</div>
			<div class="column">{{$store->storeAddress}}</div>
			<div class="column">
				<form action="/viewInventory/{{$store->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="View Inventory" class="button">
    			</form>
    		</div>
    		<div class="column">
				<form action="/disableStore/{{$store->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Disable Store" class="button">
    			</form>
    		</div>
    	</div>
@endforeach
</div>
<h3 class="is-size-5"><a href="/user">Return to admin page</a></h3>
</section>
@endsection('content')