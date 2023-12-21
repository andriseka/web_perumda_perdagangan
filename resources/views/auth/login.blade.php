<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('assets/logo/favicon.png') }}" />

	<title>Sign In | Admin Perumda Jepara</title>

	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle px-3">
						<div class="text-center mt-4">
							<h1 class="h2">Selamat Datang Kembali</h1>
							<p class="lead">
								Login untuk masuk ke dashboard
							</p>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="POST" action="{{ route('login') }}">
                                        @csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="official@astrocloud.co.id" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input id="password" type="password" placeholder="********" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
										<div>
											<div class="form-check align-items-center">
												<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
