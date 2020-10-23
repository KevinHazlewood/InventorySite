@extends('layouts.master')
@section('content')
<section class="has-text-centered">
<div class="credentials">
<h1 class="title">New Store</h1>
	<form method="POST" action="/storeRequest">
		{{ csrf_field() }}
		<div class="columns">
			<div class="column"><strong>Store Name</strong></div>
			<div class="column"><input type="text" name="storeName" value="" size="20" /></div>
		</div>
		<div class="columns">
			<div class="column"><strong>Store Address</strong></div>
			<div class="column"><input type="text" name="storeAddress" value="" size="20" /></div>
		</div>
		@include('layouts.errors')
		<div class="columns">
			  <div class="column"><input type="submit" value="Request Store" class="button"/>
			  <input type="reset" value="Reset" class="button"/> </div>
		</div>
		  
	  </form>
</div>
</section> 
@endsection('content')