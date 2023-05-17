<!DOCTYPE html>
<html>

<head>
    <style type="text/css" media="screen">
        input.largerCheckbox {
            width: 20px;
            height: 20px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

</html>

<?php
session_start();
if (isset($_POST['Delete'])) {
    if (!empty($_POST['check_list'])) {
        $tasks = $_POST['check_list'];
        $length = count($tasks);
        for ($i = 0; $i < $length; $i++) {
            deleteTodoItem($_SESSION['username'], $tasks[$i]);
        }
    }
} else if (isset($_POST['Save'])) {
    $conn = connectdatabase();
    $sql = "UPDATE todo.tasks SET done = 0";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if (!empty($_POST['check_list'])) {
        $tasks = $_POST['check_list'];
        $length = count($tasks);
        if ($length > 0) {
            for ($i = 0; $i < $length; $i++) {
                updateDone($tasks[$i]);
            }
        }
    }
}

function connectdatabase()
{
    return mysqli_connect("127.0.0.1:3306", "root", "root", "todo");
}

function loggedin()
{
    return isset($_SESSION['username']);
}

function logout()
{
    $_SESSION['error'] = "Succesfully logout !!";
    unset($_SESSION['username']);
}


function userexist($username)
{
    $conn = connectdatabase();
    $sql = "SELECT * FROM todo.users WHERE username = '" . $username . "'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if (!$result || mysqli_num_rows($result) == 0) {
        return false;
    }
    return true;
}

function validuser($username, $password)
{
    $conn = connectdatabase();
    $sql = "SELECT * FROM todo.users WHERE username = '" . $username . "'AND password = '" . $password . "'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if (!$result || mysqli_num_rows($result) == 0) {
        return false;
    }
    return true;
}

function error()
{
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">';
        echo '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
        echo '<div>';
        echo $_SESSION['error'];
        echo '</div>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        // echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

function updatepassword($username, $password)
{
    $conn = connectdatabase();
    $sql = "UPDATE todo.users SET password = '" . $password . "' WHERE username = '" . $username . "';";
    $result = mysqli_query($conn, $sql);

    $_SESSION['error'] = `<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
    <div>` . $_SESSION['error'] . `</div> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    </div>`;
    header('location:todo.php');
}

function deleteaccount($username)
{
    $conn = connectdatabase();
    $sql = "DELETE FROM todo.tasks WHERE username = '" . $username . "';";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM todo.users WHERE username = '" . $username . "';";
    $result = mysqli_query($conn, $sql);

    $_SESSION['error'] = " Account Deleted !! ";
    unset($_SESSION['username']);
    header('location:login.php');
}

function createUser($username, $password)
{
    if (!userexist($username)) {
        $conn = connectdatabase();
        $sql = "INSERT INTO todo.users (username, password) VALUES ('" . $username . "','" . $password . "')";
        $result = mysqli_query($conn, $sql);

        $_SESSION["username"] = $username;
        header('location:login.php');
    } else {
        $_SESSION['error'] = "&nbsp; Username already exists !! ";
        header('location:index.php');
    }
}

// function isValid($username, $password, $usercaptcha)
// {
//     $capcode = $_SESSION['captcha'];

//     if (!strcmp($usercaptcha, $capcode)) {
//         if (validuser($username, $password)) {
//             $_SESSION["username"] = $username;
//             header('location:todo.php');
//         } else {
//             $_SESSION['error'] = "&nbsp; Invalid Username or Password !! ";
//             header('location:login.php');
//         }
//         mysqli_close($conn);
//     } else {
//         $_SESSION['error'] = "&nbsp; Invalid captcha code !! ";
//         header('location:login.php');
//     }
// }

function isValid($username, $password)
{

    if (validuser($username, $password)) {
        $_SESSION["username"] = $username;
        header('location:todo.php');
    } else {
        $_SESSION['error'] = "&nbsp; Invalid Username or Password !! ";
        header('location:login.php');
    }
    mysqli_close($conn);
}



function getTodoItems($username)
{

    $conn = connectdatabase();
    $sql = "SELECT * FROM tasks WHERE username = '" . $username . "'";

    $result = mysqli_query($conn, $sql);

    echo `
    <svg viewBox="0 0 0 0" style="position: absolute; z-index: -1; opacity: 0;">
        <defs>
            <linearGradient id="boxGradient" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="25" y2="25">
                <stop offset="0%" stop-color="##9de005" />
                <stop offset="100%" stop-color="##7bb300" />
            </linearGradient>

            <linearGradient id="lineGradient">
                <stop offset="0%" stop-color="##9de005" />
                <stop offset="100%" stop-color="#7bb300" />
            </linearGradient>

            <path id="todo__line" stroke="url(#lineGradient)" d="M21 12.3h168v0.1z"></path>
            <path id="todo__box" stroke="url(#boxGradient)" d="M21 12.7v5c0 1.3-1 2.3-2.3 2.3H8.3C7 20 6 19 6 17.7V7.3C6 6 7 5 8.3 5h10.4C20 5 21 6 21 7.3v5.4"></path>
            <path id="todo__check" stroke="url(#boxGradient)" d="M10 13l2 2 5-5"></path>
            <circle id="todo__circle" cx="13.5" cy="12.5" r="10"></circle>
        </defs>
    </svg>`;

    echo "<form method='POST'>";
    if ($result and mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {


            if ($row['done']) {
                echo "<label class='todo'><input class='todo__state' type='checkbox' checked name='check_list[]' value='" . $row['taskid'] . "'/>";


                echo '<div class="todo__text"> ' . $row["task"] . ' </div>';
                echo '</label>';
            } else {
                echo "<label class='todo'>
                <input class='todo__state' type='checkbox' name='check_list[]' value='" . $row['taskid'] . "'/>";
                echo '<div class="todo__text"> ' . $row["task"] . ' </div>';
                echo '</label>';
            }
        }
    }
    mysqli_close($conn);
}

function addTodoItem($username, $todo_text)
{
    $conn = connectdatabase();
    $sql = "INSERT INTO todo.tasks(username, task, done) VALUES ('" . $username . "','" . $todo_text . "',0);";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function deleteTodoItem($username, $todo_id)
{
    $conn = connectdatabase();
    $sql = "DELETE FROM todo.tasks WHERE taskid = " . $todo_id . " and username = '" . $username . "';";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function updateDone($todo_id)
{
    $conn = connectdatabase();
    $sql = "UPDATE todo.tasks SET done = '1' WHERE (taskid = '" . $todo_id . "');";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
}
?>