<?php
include('default.html');
include('database.php');


if (!loggedin()) {
	header("location:login.php");
}
error();
$username = $_SESSION['username'];
if (isset($_POST['delete'])) {
	$password = $_POST['pass'];

	$conn = connectdatabase();
	$sql = "SELECT password FROM users WHERE username = '" . $username . "'";
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);
	$actual = $row['password'];

	if (strcmp($password, $actual) == 0) {

		deleteaccount($_SESSION['username']);
	} else {
		$_SESSION['error'] = "Invalid  password !!";
		error();
	}
	mysqli_close($conn);
} ?>










<head>
	<title>Delete Account | To Do</title>
</head>

<body>
	<?php error();
	?>
	<main class="card-container slideUp-animation">
		<div class="image-container">
			<h1 class="company">TO DO</h1>
			<img src="./assets/images/Inbox cleanup-rafiki.png" class="illustration" alt="">
			<p class="quote">Stay on Task: Do not go away!</p>
		</div>
		<?php
		echo `  div class="alert alert-primary d-flex align-items-center" role="alert">
             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
             Invalid Data` . $_SESSION['error'] . `
             </div>
         </div>`;
		?>
		<form method="POST">
			<div class="form-container slideRight-animation">

				<h1 class="form-header">
					<?php echo ucwords($username); ?> | Delete account
				</h1>

				<div class="input-container">
					<label for="password"></label>
					<input type="password" name="pass" id="password1" class="user-password" autocomplete="off" required>
					<span>Password</span>
					<div class="error"></div>
				</div>


				<div id="btm">
					<button type="submit" name="delete" class="submit-btn">Log In</button>
				</div>
			</div>
			</div>
		</form>
	</main>
</body>

</html>