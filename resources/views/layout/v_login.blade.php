@extends('layout.v_master')
@section('body_login')
@if(session('logincart'))
    <section class="alert alert-warning text-center">{{session('logincart')}}</section>
@endif
<div class="container-login d-flex">
	<div class="wrap-login m-5">
		<span class="login-form-title p-b-41">
			Account Login
		</span>
		<form class="login-form validate-form p-b-33 p-t-5" action="login" method="POST">
			{{ csrf_field()}}
			@if($errors->has('error'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{$errors->first('error')}}
				</div>
			@endif
			<div class="wrap-input validate-input" data-validate = "Enter email">
				<input class="input input" id="textarea" type="text" name="email" placeholder="Enter Email">
				<span class="focus-input" data-placeholder="&#xe82a;"></span>
				@if($errors->has('username'))
					<p style="color:red">{{$errors->first('username')}}</p>
				@endif
			</div>

			<div class="wrap-input validate-input" data-validate="Enter password">
				<input class="input input" type="password" name="password" placeholder="Password">
				<span class="focus-input" data-placeholder="&#xe80f;"></span>
				@if($errors->has('password'))
					<p style="color:red">{{$errors->first('password')}}</p>
				@endif
			</div>

			<div class="container-login-form-btn m-t-32">
				<button class="login-form-btn" id="button">
					Login
				</button>
			</div>

		</form>
	</div>
	<button class="login-or">OR</button>
	<div class="wrap-login m-5">
		<span class="login-form-title p-b-41">
			Register
		</span>
		<form class="login-form validate-form p-b-33 p-t-5" action="register" method="POST">
			{{csrf_field()}}
			<div class="wrap-input validate-input" data-validate = "Enter name">
				<input class="input input" id="textarea" type="text" name="name" placeholder="anh">
				<span class="focus-input" data-placeholder="&#xe82a;"></span>
			</div>

			<div class="wrap-input validate-input" data-validate = "Enter email">
				<input class="input input" id="textarea" type="text" name="email" placeholder="a@gmail.com">
				<span class="focus-input" data-placeholder="&#xe82a;"></span>
			</div>

			<div class="wrap-input validate-input" data-validate="Enter password">
				<input class="input input" type="password" name="password" placeholder="1234">
				<span class="focus-input" data-placeholder="&#xe80f;"></span>
			</div>

			<div class="container-login-form-btn m-t-32">
				<button class="login-form-btn" id="button">
					Register
				</button>
			</div>

		</form>
	</div>
</div>

@stop