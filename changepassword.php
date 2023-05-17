<?php
include('database.php');
include('default.html');

if (!loggedin()) {
    header("location:login.php");
}
error();
$username = $_SESSION['username'];
if (isset($_POST['change'])) {
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
    $confirm = $_POST['confirmPass'];

    $conn = connectdatabase();
    $sql = "SELECT password FROM users WHERE username = '" . $username . "'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $actual = $row['password'];

    if (strcmp($old, $actual) == 0) {
        if (strcmp($new, $confirm) == 0) {
            updatepassword($username, $new);
            header("location:logout.php");
        } else {
            $_SESSION['error'] = "The password does not match!";
            error();
        }
    } else {
        $_SESSION['error'] = "Invalid old password !!";
        error();
    }
    mysqli_close($conn);
} ?>

<head>
    <title>Change Password | To Do</title>
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">TO DO</h1>
            <img src="./assets/images/changePassword.png" class="illustration" alt="">
            <p class="quote">Stay on Task: Account Settings</p>
            <a href="#btm" class="mobile-btm-nav">
                <img src="./assets/images/login.png" alt="">
            </a>
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
                    <?php echo ucwords($username); ?> | Change Password
                </h1>
                <center style="text-align: center;">
                    <div class="input-container">
                        <label for="Old_Password"></label>
                        <input type="password" name="oldpass" id="Old_Password" autocomplete="off" required>
                        <span>
                            Old Password
                        </span>
                        <div class="error"></div>
                    </div>

                    <div class="input-container">
                        <label for="New_Password"></label>
                        <input type="password" name="newpass" id="newpass" class="user-password" autocomplete="off" required>
                        <span>New Password</span>
                        <div class="error"></div>
                    </div>

                    <div class="input-container">
                        <label for="confirmPass"></label>
                        <input type="password" name="confirmPass" id="password2" class="password-confirmation" required>
                        <span>
                            Confirm Password
                        </span>
                        <div class="error"></div>
                    </div>

                    <br />

                    <div id="btm ">
                        <input type="submit" name="change" class="submit-btn " value="Change" />
                    </div>
                </center>


                <!-- <div id="btm row">
                    <button type="reset" class="reset-btn" id="reset" style=" border: 0;
                        background-color: var(--dusky-green);
                        color: white;
                        padding: 10px 50px;
                        letter-spacing: .05em;
                        border-radius: 5px;
                        margin-top: 20px;
                        font-size: 17px;
                        outline: none;">Reset Data</button>
                </div> -->
            </div>
        </form>
    </main>
</body>

</html>