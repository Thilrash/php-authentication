<?php 
    //error_reporting(E_ERROR | E_PARSE);
    include('server.php') 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auentication</title>
    <link href="./style/style.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h2>Sign Up</h2>
    </div>

    <!-- form -->
    <form action="register.php" method="post">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
         <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Sign Up</button>
        </div>
        <p>Already a member <a href="login.php">Sign In</a></p>
    </form>
</body>
</html>