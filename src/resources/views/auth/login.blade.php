@section('title', $data['title'])
@section('id-body', 'id="login"')

@section('content')

@include('layout.alert')

<section class="login">
	<div class="centering">
		<div class="fix">
			<img src="images/DSA-01.svg" alt="" height="100" />
			<div class="line"></div>

			{!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}
				<h1 class="dt">
					Sign in
				</h1>

				<figcaption class="fig-s">Email / Username</figcaption>
				<input type="text" placeholder="username?" value="{{ old('username') }}" class="form-control" name="username" required/>

				<figcaption class="fig-s">Password</figcaption>
				<input type="password" class="form-control" name="password" required/>

				<button type="submit" class="btn btn-content-inv" style="width:100%;margin-top:15px;margin-bottom:15px;">Sign in
				</button>
				<p class="foot">© 2016 DynEd Study Apps. <a href="#">Privacy Policy</a></p>
			{!! Form::close() !!}
		</div>
	</div>
</section>
@stop