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
<html lang="en-US">

<head>
    <!--Bootstrap-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--Favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">

    <!--Website Title-->
    <title>Login Information</title>

    <!--Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" type="text/css" >

</head>

<body id="home_page">

//Top bar menu
<div class="navbar">
    <nav id="nav_menu">
        <a href="index.html">
            <img src="images/logo1.jpg" alt = "Axel Kouassi Personal Logo" id = "logo"></a>
        <a href="questions.html"class ="right_align">Questions</a>
        <a href="register.html"class ="right_align">Register</a>
        <a href="login.html" class ="right_align">Login</a>
    </nav>
</div>



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
