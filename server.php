<?php 
session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();

// Connect to the database
$database = mysqli_connect('localhost', 'root', '', 'test_databse');

// register the user
if(isset($_POST['reg_user'])) {
    // recieve all input values from the form
    $username = mysqli_real_escape_string($database, $_POST['username']);
    $email = mysqli_real_escape_string($database, $_POST['email']);
    $password_1 = mysqli_real_escape_string($database, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($database, $_POST['password_2']);

    // form validation
    if(empty($username)) {
        array_push($errors, "Username is required!");
    }
    if(empty($email)) {
        array_push($errors, "Email is required!");
    }
    if(empty($password_1)) {
        array_push($errors, "Password is required!");
    }
    if($password_1 != $password_2) {
        array_push($errors, "The passwords are missed match!");
    }

    // check the database whether user already exist or not
    $user_check_query = "SELECT * FROM authentication WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($database, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user) {
        if($user['username'] === $username) {
            array_push($errors, 'Username already exists');
        }

        if($user['email'] === $email) {
            array_push($errors, 'Email already exists');
        }
    }

    if(count($errors) == 0) {
        $password = md5($password_1); // encrypting password
        //$password = $password_1;
        $query = "INSERT INTO authentication (username, email, password) VALUES('$username', '$email', '$password')";
        mysqli_query($database, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in.";
        header('location: index.php');
    }
}

// login user
if(isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($database, $_POST['username']);
    $password = mysqli_real_escape_string($database, $_POST['password']);

    if(empty($username)) {
        array_push($errors, "Username is required!");
    }

    if(empty($password)) {
        array_push($errors, "Password is required!");
    }

    if(count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM authentication WHERE username='$username' AND password='$password'";
        $results = mysqli_query($database, $query);

        if(mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in.";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username or password combination");
        }
    }
}
?>