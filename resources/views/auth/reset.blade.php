
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Reset | Recruitment App</title>

	<link href="{{ asset('template') }}/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						@if (session('success'))
						<div class="alert alert-success" role="alert">
							{{ session('success') }}
						</div>
						@elseif (@session('error'))
						<div class="alert alert-danger" role="alert">
							{{ session('error') }}
						</div>
						@endif
						<div class="card">
							<div class="card-body">
								<div class="text-center mt-4">
									<h1 class="h2">Reset Password!</h1>
									<p class="lead">
										Input your email here, we will send you link for your password reset.
									</p>
								</div>
								<div class="m-sm-3">
									<form method="POST" action="{{ route('auth.reset.store') }}">
                                        @csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Enter your email" />
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
										</div>
										<div class="d-grid gap-2 mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary" value="Reset">
                                            <a href="{{ route('auth.login') }}">Login</a>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Don't have an account? <a href="{{ route('auth.register') }}">Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>