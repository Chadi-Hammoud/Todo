<?php 
    include 'database.php';

    $username = $_POST['username'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    // $usercaptcha = $_POST['captcha'];
    // $captcha = $_SESSION['captcha'];
   
    // if(strcmp($usercaptcha,$captcha)==0)
    // {
        if(strcmp($pass1,$pass2)==0) {
            createUser($username, $pass1);
        }
        else {
            $_SESSION['error'] = "&nbsp; password do not match";
            header('location:index.php');
        }
    // }
    // else {
    //     echo `  div class="alert alert-danger d-flex align-items-center" role="alert">
    //     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    //     <div>
    //       Invalid Data` . $_SESSION['error'] . `
    //     </div>
    //   </div>`;
    //     // $_SESSION['error'] = "&nbsp; Invalid captcha code";
    //  header('location:index.php');
    // }
 ?>