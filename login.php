<?php
include('default.html');
include('database.php');

if (loggedin()) {
    header("location:todo.php");
}
?>

<head>
    <title>Log In | To Do</title>
</head>
<body>
    <?php error();
    ?>
    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">TO DO</h1>
            <img src="./assets/images/signUp.svg" class="illustration" alt="">
            <p class="quote">Stay on Task: Log In and Get Organized with Our Todo App</p>
        </div>
        <?php
        echo `  div class="alert alert-primary d-flex align-items-center" role="alert">
             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
             Invalid Data` . $_SESSION['error'] . `
             </div>
         </div>`;
        ?>
        <form action="valid.php" method="POST">
            <div class="form-container slideRight-animation">

                <h1 class="form-header">
                    Log In
                </h1>

                <div class="input-container">
                    <label for="username"></label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                    <span>
                        Username
                    </span>
                    <div class="error"></div>
                </div>


                <div class="input-container">
                    <label for="password"></label>
                    <input type="password" name="password" id="password1" class="user-password" autocomplete="off" required>
                    <span>Password</span>
                    <div class="error"></div>
                </div>


                <div id="btm">
                    <button type="submit" class="submit-btn">Log In</button>
                    <p class="btm-text">
                        Don't have an account? <span class="btm-text-highlighted"> <a href="index.php" title="Login"> Register Now!</a></span>
                    </p>
                </div>

                <!-- <div id="btm row">
                    <button type="reset" class="reset-btn" id="reset" style=" border: 0;
                        background-color: var(--dusky-green);
                        color: white;
                        padding: 10px 50px;
                        letter-spacing: .05em;
                        border-radius: 5px;
                        margin-top: 20px;
                        font-size: 17px;
                        outline: none;">Reset Data</button> -->
            </div>
            </div>
        </form>
    </main>
</body>

</html>