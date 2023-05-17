<?php
include('default.html');
include('database.php');

if (loggedin()) {
    header("location:todo.php");
}
?>

<head>
    <title>Sign up | To Do</title>
</head>

<body>
    <?php error();
    ?>
    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">TO DO</h1>
            <img src="./assets/images/Mobile login-pana.png" class="illustration" alt="">
            <p class="quote">Sign up today to get exciting offers..!</p>
            <a href="#btm" class="mobile-btm-nav">
                <img src="./assets/images/dbl-arrow.png" alt="">
            </a>
        </div>
        <?php
        echo `  div class="alert alert-danger d-flex align-items-center" role="alert">
             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
             Invalid Data` . $_SESSION['error'] . `
             </div>
         </div>`;
        ?>
        <form action="adduser.php" method="POST">

            <div class="form-container slideRight-animation">

                <h1 class="form-header">
                    Get started
                </h1>

                <div class="input-container">
                    <label for="username"></label>
                    <input type="text" name="username" id="username" required>
                    <span>
                        First name
                    </span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="l-name"></label>
                    <input type="text" name="l-name" id="l-name" required>
                    <span>
                        Last name
                    </span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="password1"></label>
                    <input type="password" name="password1" id="password1" class="user-password" required>
                    <span>Password</span>
                    <div class="error"></div>
                </div>

                <div class="input-container">
                    <label for="password2"></label>
                    <input type="password" name="password2" id="password2" class="password-confirmation" required>
                    <span>
                        Confirm Password
                    </span>
                    <div class="error"></div>
                </div>
                <!-- 
                <div class="input-container">
                    <label for="captcha">

                    </label>
                    <input type="text" name="captcha" id="captcha" autocomplete="off" required>
                    <span>
                        <?php
                        // $capcode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
                        // $capcode = substr(str_shuffle($capcode), 0, 6);
                        // $_SESSION['captcha'] = $capcode;
                        // echo '<div class = "unselectable">Enter this code: ' . $capcode . '</div>';
                        ?>
                    </span>
                    <div class="error"></div>
                </div> -->


                <!-- <br /> -->
                <div id="btm">
                    <button type="submit" class="submit-btn">Create Account</button>
                    <p class="btm-text">
                        Already have an account..? <span class="btm-text-highlighted"> <a href="login.php" title="Login"> Log in</a></span>
                    </p>
                </div>

                <div id="btm row">
                    <button type="reset" class="reset-btn" id="reset" style=" border: 0;
                        background-color: var(--dusky-green);
                        color: white;
                        padding: 10px 50px;
                        letter-spacing: .05em;
                        border-radius: 5px;
                        margin-top: 20px;
                        font-size: 17px;
                        outline: none;">Reset Data</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>