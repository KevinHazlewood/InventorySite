@extends('layouts.master')
@section('content')
<section class="section">
<h1 class="title">Admin Page</h1>
<h3 class="is-size-4">Stores pending approval</h3>
<div class="owner">
@foreach($stores as $store)
	<div class="columns">
			<div class="column">{{$store->storeName}}</div>
			<div class="column">{{$store->storeAddress}}</div>
			<div class="column">
				<form action="/acceptStore/{{$store->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Add Store" class="button">
    			</form>
    		</div>
    		<div class="column">
				<form action="/removeStore/{{$store->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Remove Store" class="button">
    			</form>
    		</div>
    	</div>
@endforeach
</div>
<h3 class="is-size-5"><a href="/manageStores">Manage Current Stores</a></h3>
</section>
@endsection('content')