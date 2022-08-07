<?php
   ob_start();
   session_start();
?>
<?php
	$msg = '';

	if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])){
		require "koneksi.php";

		$msg = '';
    
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$sql 		= "SELECT * FROM auth WHERE username = '$username' AND password = '$password'";

		$result = mysqli_query($koneksi, $sql);
		$row 		= mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count 	= mysqli_num_rows($result);

		if ($count > 0) {
			$_SESSION['valid'] = true;
			$_SESSION['timeout'] = time();
			$_SESSION['username'] = $username;	

			header('Location: index.php');
		}else {
			$msg = 'Wrong username or password';
		}
	}

?>

<html>
	<head>
		<style>
			body {
				background: #007bff;
				background: linear-gradient(to right, #0062E6, #33AEFF);
			}

			.btn-login {
				font-size: 0.9rem;
				letter-spacing: 0.05rem;
				padding: 0.75rem 1rem;
			}

			.btn-google {
				color: white !important;
				background-color: #ea4335;
			}

			.btn-facebook {
				color: white !important;
				background-color: #3b5998;
			}
		</style>
		<link rel="stylesheet" href="./assets/css/all.min.css">
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<div class="card border-0 shadow rounded-3 my-5">
						<div class="card-body p-4 p-sm-5">
							<h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
							<form method="post" action="#">
								<div class="form-floating mb-3">
									<input type="username" class="form-control" id="floatingInput" name="username" placeholder="username">
									<label for="floatingInput">Username</label>
								</div>
								<div class="form-floating mb-3">
									<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
									<label for="floatingPassword">Password</label>
								</div>
								<div class="d-grid">
									<button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Sign
										in</button>
								</div>
								<?php

										if($msg !== ""){?>
											<hr class="my-4">
											<label class="card-title center text-danger text-center fw-light"><?=$msg?></label>
							<?php }
								?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script>
	</body>
</html>
<?php

?>