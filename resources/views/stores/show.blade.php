@extends('layouts.master')
@section('content')
<section class="section has-text-centered background">
<br/>
<h2 class="title">{{ $store->storeName }} Inventory</h2>
<br/>
<table class="table is-centered" align="center" width = "50%" id="inv">
	<th class="has-text-centered">Id</th><th class="has-text-centered">Item Name</th>
	<th class="has-text-centered">Price</th><th class="has-text-centered">Quantity</th>
	<th></th>
	@foreach($items as $item)
		<tr>
			<td class="has-text-centered">{{$item->id}}</td><td class="has-text-centered">{{$item->itemName}}</td>
			<td class="has-text-centered">${{$item->itemPrice}}</td><td class="has-text-centered">{{$item->itemQuantity}}</td>
			<td class="has-text-centered"><form action="/editItem/{{$item->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Edit Item" class="button">
    			</form></td>
    		<td class="has-text-centered"><form action="/removeItem/{{$item->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Remove Item" class="button">
    			</form></td>
		</tr>
	@endforeach
	
		<tr>
			<form action="/addItem" method="POST">
				   	{{ csrf_field() }}
			<td class="has-text-centered">New Item</td>
            <td class="has-text-centered"><input type='text' size='8' name='itemName'></td>
            <td class="has-text-centered">$<input type='text' size='8' name='itemPrice'></td>
            <td class="has-text-centered"><input type='text' size='8' name='itemQuantity'></td>
            <td class="has-text-centered"><input type='submit' value='Add Item' class="button"></td>
            <td></td>
            </form></tr>
		</tr>
</table>
@include('layouts.errors')
<script>
	function select(){
			this.setAttribute("class", "is-selected");
	};
	function unselect(){
			this.setAttribute("class", "");
	};
		
	var el = document.getElementsByTagName('tr');

	for($i = 1; $i<el.length; $i++){
		el[$i].addEventListener("mouseover", select);	
		el[$i].addEventListener("mouseout", unselect);
	}
	
</script>

@endsection('content')