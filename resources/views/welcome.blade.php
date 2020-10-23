@extends('layouts.master')
@section('content')
<section class="section has-text-centered background">
<p class="title">Welcome To The KH Inventory Management System</p>
<p class="is-size-5">The perfect way to manage the inventory of your small business or online store</p>
@if(Auth::check())
<p class="is-size-5">Welcome, {{Auth::user()->firstName}}</p>
@endif
<img src="img/sample.jpg" width="50%" height="20%"></img><br/><br/>
<a class="button" 
      @if (Auth::check())
        href="user"
      @else
        href="login"
      @endif
      >Get Started!</a>
</section>
@endsection('content')
