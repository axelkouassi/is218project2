<?php

// Getting input data from users
$email_address = filter_input(INPUT_POST,'email_address');
$password = filter_input(INPUT_POST,'password');

//Declaring and initializing variable to store password length
$password_length = strlen($password);

//Checking emptiness validation

//Email Emptiness Validation
if(empty($email_address)){
    $email_address = 'Email Address is required! Cannot Be Empty!';
    }
//Email "@" character check
else if((stripos($email_address,'@')) === false){
    $email_address = 'Email must contain "@"!';
}

else {
    $email_address = filter_input(INPUT_POST,'email_address');
    }

//Password Emptiness Validation
if(empty($password)){
    $password = 'Password is required! Cannot Be Empty!';
}
//Password length validation
else if($password_length < 8){
    $password = 'Invalid password! Password must be at least 8 characters!';
}

else {
    $password = filter_input(INPUT_POST,'password');
    }

?>

<!-- HTML Document-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Login Information</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- Header Menu -->

<nav id="nav_menu">
    <a href="index.html" class="home">Home</a>
    <a href="login.html" class="login_active">Login</a>
    <a href="register.html">Register</a>
    <a href="questions.html">Questions</a>
</nav>

<main>
    <h1>Login Credentials</h1>
    <div>
        <label>Email Address: </label>
        <span><?php echo htmlspecialchars($email_address); ?></span><br>

        <label>Password: </label>
        <span><?php echo htmlspecialchars($password); ?></span><br>
    </div>

</main>
</body>
</html>
