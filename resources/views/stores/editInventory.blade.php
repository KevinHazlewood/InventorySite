@extends('layouts.master')
@section('content')
<section class="has-text-centered">
<div class="credentials">
<h1 class="title">Edit Inventory Item</h1>
	<form method="POST" action="/saveItemEdits/{{$item->id}}">
		{{ csrf_field() }}
		  <div class="columns">
			<div class="column is-half"><strong>Item ID</strong></div>
			<div class="column is-half has-text-centered"><p name="id">{{$item->id}}</p></div>
		  </div>
		  <div class="columns">
			<div class="column is-half"><strong>Item Name</strong></div>
			<div class="column is-half" width = "30"><input type="text" name="itemName" value="{{$item->itemName}}" size="15" /></div>
		  </div>
		  <div class="columns">
			<div class="column is-half"><strong>Unit Price</strong></div>
			<div class="column is-half"><p>$<input type="text" name="itemPrice" value="{{$item->itemPrice}}" size="13"/></p></div>
		  </div>
		  <div class="columns">
			<div class="column is-half has-text-centered"><strong>Quantity</strong></div>
			<div class="column is-half"><input type="text" name="itemQuantity" value="{{$item->itemQuantity}}" size="15" /></div>
		  </div>
		  <div class="columns">
			<div class="column">
			  <input type="submit" value="Save Edits" class="button"/>
			</div>
		  </div>
	  </form>
	  
</div>
</section>
@endsection('content')