@extends('layouts.master')
@section('content')
<?php 
	$user = Auth::user();
	$store = DB::table('stores')->find($user->storeId);
?>
<section class="section">
<h1 class="title">{{ $store->storeName }} Owner Page</h1>
<h3>Welcome {{$user->firstName}}</h3>
<a href="/inventory"><p>Go To Inventory Page</p></a>
<br/>
<div class="owner">
<div class="columns">
	<div class="column" id="label">Store Address:</div>
	<div class="column"><p id="address">{{$store->storeAddress}}</p></div>
	<div class="column" id="btnDiv"><button class="button" id="editAddress">Edit Address</button></div>
</div>
</div>
<br/>

<div class="owner">
<h3 class="is-size-3">Current Employees</h3>
	@foreach($employees as $employee)
		<div class="columns">
			@if($employee->id != $user->id)
			<div class="column">{{$employee->firstName}} {{$employee->lastName}}</div>
			<div class="column">
				<form action="/removeEmployee/{{$employee->id}}" method="POST">
				   	{{ csrf_field() }}
        			<input type="submit" value="Remove Employee">
    			</form>
    		</div>
    		@else
    		<div class="column"><p class="has-text-weight-bold">{{$employee->firstName}} {{$employee->lastName}}</p></div>
    		<div class="column">Owner</div>
    		@endif
		</div>
	@endforeach
</div>
<br/>
<br/>
<div class="owner">
<h3 class="is-size-4">Add New Employees</h3>
<p class="is-size-6">To add an employee, you will need their user ID.<br/>Your employees will find this on their user page.</p>
<p class="is-size-6">Employees will have full access to your store's inventory</p><br/>
	<form method="POST" action="/addEmployee">
		{{ csrf_field() }}
		  <div class="columns">
			<div class="column"><strong>Employee's ID:</strong></div>
			<div class="column"><input type="text" name="id" value="" size="20" /></div>
		  </div>
		  @include('layouts.errors')
		  <div class="columns">
			<div class="column">
			  <input type="submit" value="Add Employee" class="button"/>
			  <input type="reset" value="Reset" class="button"/> 
			</div>
		  </div>
	  </form>
	 </div>
	  </section>
<script>
	function edit(){
		//this.style.display = "none";
		var el2 = document.getElementById('address');
		el2.outerHTML = '<form method="POST" action="/editAddress">{{ csrf_field() }}<input type="text" name="id" value="{{$store->storeAddress}}" size="20"/><input type="submit" value="Save Changes" class="button"/></form>'
		var el3 = document.getElementById('label');
		el3.innerHTML="New Address:";
		var el4 = document.getElementById('btnDiv');
		el4.style.display = "none";
	};
	
		
	var el = document.getElementById('editAddress');

	el.addEventListener("click", edit);
	
</script>
@endsection('content')