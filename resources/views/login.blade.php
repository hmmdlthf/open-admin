<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{config('admin.title')}} | {{ __('admin.login') }}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		@if(!is_null($favicon = Admin::favicon()))
		<link rel="shortcut icon" href="{{$favicon}}">
		@endif

		<link rel="stylesheet" href="{{ Admin::asset("open-admin/css/styles.css")}}">

		@foreach(Admin::cssForLogin() ?? [] as $cssFile)
			<link rel="stylesheet" href="{{ $cssFile }}">
		@endforeach

		<script src="{{ Admin::asset("bootstrap5/bootstrap.bundle.min.js")}}"></script>

	</head>
	<body class="bg-light {{ config('admin.skin') ?? '' }}">
		@if(config('admin.login_layout') === 'login-split-screen')
			<div class="row g-0 vh-100">
				<div class="col-md-6 d-none d-md-block" style="background: url({{ config('admin.login_background_image') ?: Admin::asset('open-admin/img/login-left.jpg') }}) center/cover no-repeat;">
					{{-- left visual / illustration --}}
				</div>
				<div class="col-md-6 d-flex align-items-center justify-content-center">
					<div class="container m-4" style="max-width:400px;">
						<div class="text-center mb-3">
							<a href="{{ admin_url('/') }}" class="text-decoration-none text-dark">
								<div class="mb-2">{!! config('admin.logo') !!}</div>
							</a>
							<p class="text-muted small mb-0">Secure access to {{ config('admin.name') }} Software</p>
						</div>
						<div class="">

							@if($errors->has('attempts'))
								<div class="alert alert-danger m-0 text-center">{{$errors->first('attempts')}}</div>
							@else

							<form action="{{ admin_url('auth/login') }}" method="post" class="needs-validation" novalidate>

								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								@if(config('admin.login_companies'))
								<div class="mb-3">
									<label class="form-label">{{ __('Company') }}</label>
									<select name="company" class="form-select" required>
										@foreach(config('admin.login_companies') as $key => $label)
											<option value="{{ $key }}" {{ old('company') == $key ? 'selected' : '' }}>{{ $label }}</option>
										@endforeach
									</select>
								</div>
								@endif

								<div class="mb-3">

									@if($errors->has('username'))
										<div class="alert alert-danger">{{$errors->first('username')}}</div>
									@endif

									<label for="username" class="form-label">{{ __('admin.username') }}</label>
									<div class="input-group mb-3">
										<span class="input-group-text"><i class="icon-user"></i></span>
										<input type="text" class="form-control" placeholder="{{ __('admin.username') }}" name="username" id="username" value="{{ old('username') }}" required>
									</div>
								</div>

								<div class="mb-3">
									<label for="password" class="form-label">{{ __('admin.password') }}</label>
									<div class="input-group mb-3">
										<span class="input-group-text"><i class="icon-eye"></i></span>
										<input type="password" class="form-control" placeholder="{{ __('admin.password') }}" name="password" id="password" required>
										<button type="button" class="btn btn-outline-secondary btn-show-password" title="Show/Hide"><i class="icon-eye"></i></button>
									</div>

									@if($errors->has('password'))
										<div class="alert alert-danger">{{$errors->first('password') }}</div>
									@endif
								</div>

								<div class="d-flex justify-content-between align-items-center mb-3">
									@if(config('admin.auth.remember'))
									<div class="form-check mb-0">
										<input type="checkbox" class="form-check-input" name="remember" id="remember" value="1"  {{ (old('remember')) ? 'checked="checked"' : '' }}>
										<label class="form-check-label" for="remember">{{ __('admin.remember_me') }}</label>
									</div>
									@endif
									<!-- <a href="{{ admin_url('auth/forgot') }}" class="small">{{ __('admin.forgot_password') }}</a> -->
								</div>

								<div class="clearfix">
									<button type="submit" class="btn float-end btn-secondary w-100">{{ __('admin.login') }}</button>
								</div>

							</form>
							@endif

							<!-- Copyright / credits -->
							<div class="text-center small text-muted mt-4 mb-3">
								&copy; {{ date('Y') }} {{ config('admin.name') ?: config('app.name') }}. All rights reserved.
								@if(config('admin.show_version', true))
									&nbsp;<br>Powered by <a href="https://caaqit.com" target="_blank" rel="noopener noreferrer">CAAQIT (PVT) LTD.</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		@else
			<div class="d-flex justify-content-center align-items-center h-100" @if(config('admin.login_background_image'))style="background: url({{config('admin.login_background_image')}}) no-repeat;background-size: cover;"@endif>
				<div class="container m-4" style="max-width:400px;">
					<div class="text-center mb-3">
						<a href="{{ admin_url('/') }}" class="text-decoration-none text-dark">
							<div class="mb-2">{!! config('admin.logo') !!}</div>
						</a>
						<p class="text-muted small mb-0">Secure access to {{ config('admin.name') }} Software</p>
					</div>
					<div class="bg-body p-4 shadow-sm rounded-3">

						@if($errors->has('attempts'))
							<div class="alert alert-danger m-0 text-center">{{$errors->first('attempts')}}</div>
						@else

						<form action="{{ admin_url('auth/login') }}" method="post">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="mb-3">

								@if($errors->has('username'))
									<div class="alert alert-danger">{{$errors->first('username')}}</div>
								@endif

								<label for="username" class="form-label">{{ __('admin.username') }}</label>
								<div class="input-group mb-3">
									<span class="input-group-text"><i class="icon-user"></i></span>
									<input type="text" class="form-control" placeholder="{{ __('admin.username') }}" name="username" id="username" value="{{ old('username') }}" required>
								</div>
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">{{ __('admin.password') }}</label>
								<div class="input-group mb-3">
									<span class="input-group-text"><i class="icon-eye"></i></span>
									<input type="password" class="form-control" placeholder="{{ __('admin.password') }}" name="password" id="password" required>
								</div>

								@if($errors->has('password'))
									<div class="alert alert-danger">{{$errors->first('password') }}</div>
								@endif
							</div>

							@if(config('admin.auth.remember'))
							<div class="mb-3 form-check">
								<input type="checkbox" class="form-check-input" name="remember" id="remember" value="1"  {{ (old('remember')) ? 'checked="checked"' : '' }}>
								<label class="form-check-label" for="remember">{{ __('admin.remember_me') }}</label>
							</div>
							@endif

							<div class="clearfix">
								<button type="submit" class="btn float-end btn-secondary w-100">{{ __('admin.login') }}</button>
							</div>

						</form>
						@endif

						<!-- Copyright / credits -->
						<div class="text-center small text-muted mt-4 mb-3">
							&copy; {{ date('Y') }} {{ config('admin.name') ?: config('app.name') }}. All rights reserved.
							@if(config('admin.show_version', true))
								&nbsp;<br>Powered by <a href="https://caaqit.com" target="_blank" rel="noopener noreferrer">CAAQIT (PVT) LTD.</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endif
		<script>
		// Toggle password visibility
		document.addEventListener('click', function (e) {
			if (e.target.closest('.btn-show-password')) {
				var btn = e.target.closest('.btn-show-password');
				var wrapper = btn.closest('.input-group');
				var input = wrapper.querySelector('input[type="password"], input[type="text"]');
				if (input) {
					if (input.type === 'password') {
						input.type = 'text';
					} else {
						input.type = 'password';
					}
				}
			}
		});

		// Bootstrap-style client-side validation
		(function () {
			var forms = document.querySelectorAll('.needs-validation');
			Array.prototype.slice.call(forms).forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		})();
		</script>

		
	</body>
</html>
