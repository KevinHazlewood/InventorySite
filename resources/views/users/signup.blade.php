@extends('layouts.master')
@section('content')
<section class="has-text-centered">
<div class="credentials">
<h1 class="title">Signup</h1>
	<form method="POST" action="/signup">
		{{ csrf_field() }}
		  <div class="columns">
			<div class="column"><strong>Email Address</strong></div>
			<div class="column"><input type="text" name="email" value="" size="20" /></div>
		  </div>
		  <div class="columns">
			<div class="column"><strong>First Name</strong></div>
			<div class="column"><input type="text" name="firstName" value="" size="20" /></div>
		  </div>
		  <div class="columns">
			<div class="column"><strong>Last Name</strong></div>
			<div class="column"><input type="text" name="lastName" value="" size="20" /></div>
		  </div>
		  <div class="columns">
			<div class="column"><strong>Password</strong></div>
			<div class="column"><input type="password" name="password" value="" size="20" /></div>
		  </div>
		  <div class="columns">
			<div class="column"><strong>Confirm Password</strong></div>
			<div class="column"><input type="password" name="password_confirmation" value="" size="20" /></div>
		  </div>
		  <div class="columns">
		  	<div class="column"><strong>Register as an:</strong></div>
				<div class="column"><input type="radio" id="owner" name="userType" value="2"><label for="owner">Owner </label>
					<input type="radio" id="employee" name="userType" value="3"><label for="employee">Employee</label>
				</div>
		  </div>
		  <p><a href="login">Already have account? Click here log in.</a></p><br/>
		  @include('layouts.errors') 	
		  <div class="columns">
			<div class="column">
			  <input type="submit" value="Sign Up" class="button"/>
			  <input type="reset" value="Reset" class="button"/> 
			</div>
		  </div>
	  </form>

</div>
</section>
@endsection('content')