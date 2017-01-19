

@extends('layouts.app')

@section('content')
	@parent
	<!-- Login -->
	<div class="col-md-4 hidden">
		<form>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>
			<div class="form-group">
				<label for="exampleInputFile">File input</label>
				<input type="file" id="exampleInputFile">
				<p class="help-block">Example block-level help text here.</p>
			</div>
			<label class="checkbox-inline">
			  <input name="enabled" type="checkbox" checked data-toggle="toggle"> enabled
			</label>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
	<!-- Create -->
	<!-- Contents  -->
	<div class="col-md-6">
		<form class="userform">
			{{ csrf_field() }}
			<div id="alertDiv">
			</div>
			<div class="form-group">
				<label for="username">User Name</label>
				<input name="name" type="username" class="form-control" id="name" placeholder="Username">
			</div>
			<div class="form-group password-group">
				<label for="password">Password</label>
				<input name="password" type="password" class="form-control" id="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input name="email" type="email" class="form-control" id="email" placeholder="Email">
			</div>
			<div class="checkbox">
		    <label><input name="enabled" type="checkbox" id="enabled"></label>
		  </div>

			<div class="form-group">
				<button type="button" class="btn btn-default save-btn"> Save </button>
				<button type="button" class="btn btn-default new-btn"> New </button>
			</div>
		</form>
	</div>
	<div class="col-md-5 list-div">
		<!-- User list  -->
		@include('users')
	</div>
@endsection
