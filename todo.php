<?php
include('database.php');
include('default.html');

if (!loggedin()) {
	header("location:login.php");
}

$username = $_SESSION['username'];
error();
// echo "<br> <center id='user'> Welcome " . ucwords($username) . "</center> <br>";

if (isset($_POST['addtask'])) {
	if (!empty($_POST['description'])) {
		addTodoItem($_SESSION['username'], $_POST['description']);
		header("Refresh:0");
	}
}
?>

<head>
	<title>Workspace | To Do</title>
	<style>
		/* .todo-list {
			background: #FFF;
			font-size: 20px;
			max-width: 15em;
			margin: auto;
			padding: 0.5em 1em;
			box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
		} */

		.todo {
			display: block;
			position: relative;
			padding: 1em 1em 1em 16%;
			margin: 0 auto;
			cursor: pointer;
			border-bottom: solid 1px #ddd;
		}


		.todo__state {
			position: absolute;
			top: 0;
			left: 0;
			opacity: 0;
		}

		.todo__text {
			color: #ff0000;
			transition: all 0.4s linear 0.4s;
		}

		.todo__state:checked~.todo__text {
			transition-delay: 0s;
			color: #40ff00;
			opacity: 0.6;
		}
	</style>
</head>

<body>
	<?php
	include('nav.php');
	?>
	<?php error();
	?>
	<main class="card-container slideUp-animation">

		<div class="image-container">
			<h1 class="company">TO DO</h1>
			<img src="./assets/images/To do list-rafiki.svg" class="illustration" alt="">
		</div>
		<?php
		echo `  div class="alert alert-primary d-flex align-items-center" role="alert">
             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
             Invalid Data` . $_SESSION['error'] . `
             </div>
         </div>`;
		?>
		<div class="todo-list ">
			<div class="justify-content-center align-items-center">
				<form action="todo.php" method="POST">
					<input type="text" class="p-2" size="50" placeholder=" Title" name="description" autocomplete="off" />
					<input type="submit" class="p-2" name="addtask" value="Add" />
				</form>
			</div>

			<?php
			getTodoItems($username);
			?>

			<div style="flex: 1 ;">
				<button type='submit' name='Delete' value='Delete'>Delete</button>
				<button type='submit' name='Save'>Save</button>
			</div>
			</form>
		</div>

	</main>
</body>

</html>