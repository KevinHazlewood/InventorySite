@extends('layouts.master')
@section('content')

<section class="has-text-centered">
<div class="credentials">
<h1 class="title">Login</h1>
	<form method="POST" action="/login">
		{{ csrf_field() }}
		  <div class="columns">
			<div class="column"><strong>Email Address</strong></div>
			<div class="column"><input type="text" name="email" value="" size="20" /></div>
		  </div>
		  <div class="columns">
			<div class="column"><strong>Password</strong></div>
			<div class="column"><input type="password" name="password" value="" size="20" /></div>
		  </div>
		  <p><a href="signup">Don't have account? Click here to register.</a></p><br/>
		  @include('layouts.errors')
		  <div class="columns">
			  <div class="column"><input type="submit" value="Log In" class="button"/>
			  <input type="reset" value="Reset" class="button"/> </div>
		  </div>
	  </form>	  
</div>
</section>
@endsection('content')