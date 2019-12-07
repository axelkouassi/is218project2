<?php

require ('pdo.php');

// Getting input data from users
$first_name = filter_input(INPUT_POST,'first_name');
$last_name = filter_input(INPUT_POST,'last_name');
$birthday = filter_input(INPUT_POST,'birthday');
$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST,'password');
$action = filter_input(INPUT_POST,'action');


//Declaring and initializing variable to store password length
$password_length = strlen($password);

//Checking emptiness validation

//First Name Emptiness Validation
if(empty($first_name)){
    $first_name = 'First Name is required! Cannot Be Empty!';
}
else {
    $first_name = filter_input(INPUT_POST,'first_name');
}

//Last Name Emptiness Validation
if(empty($last_name)){
    $last_name = 'Last Name is required! Cannot Be Empty!';
}
else {
    $last_name = filter_input(INPUT_POST,'last_name');
}

//Birthday Emptiness Validation
if(empty($birthday)){
    $birthday = 'Birthday is required! Cannot Be Empty!';
}
else {
    $birthday = filter_input(INPUT_POST,'birthday');
}

//Email Emptiness Validation
if(empty($email)){
    $email = 'Email Address is required! Cannot Be Empty!';
}
//Email "@" character check
else if((stripos($email,'@')) === false){
    $email = 'Password must contain "@"!';
}
//Email format validation
else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $email = 'Invalid email format';
}
else {
    $email = filter_input(INPUT_POST,'email');
}

//Password Emptiness Validation
if(empty($password)){
    $password = 'Password is required! Cannot Be Empty!';
}
//Password length validation
else if($password_length < 8){
    $password = 'Invalid password! Password must be at least 8 characters!';
}

//If statement to redirect to login page after registration
if ($action){
    header('location: login.html');
}

?>

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
    <title>Registration Information</title>

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
    <h1>Registration Information</h1>
    <label>First Name: </label>
    <span><?php echo htmlspecialchars($first_name); ?></span><br>

    <label>Last Name: </label>
    <span><?php echo htmlspecialchars($last_name); ?></span><br>

    <label>Birthday: </label>
    <span><?php echo htmlspecialchars($birthday); ?></span><br>

    <label>Email: </label>
    <span><?php echo htmlspecialchars($email); ?></span><br>

    <label>Password: </label>
    <span><?php echo htmlspecialchars($password); ?></span><br>
</main>

<?php
// Testing database
if (strlen($password) >= 8){


    // SQL Query
    $query = 'INSERT INTO accounts
          (email, fname, lname, birthday, password)
          VALUES
          (:email, :fname, :lname, :birthday, :password)';

//Create PDO Statement

    $statement = $db->prepare($query);

//Bind Form Values to SQL
    $statement -> bindValue(':fname',$first_name);
    $statement -> bindValue(':lname',$last_name);
    $statement -> bindValue(':birthday',$birthday);
    $statement -> bindValue(':email',$email);
    $statement -> bindValue(':password',$password);

//Execute the SQL Query
    $statement->execute();

//Close the database connection
    $statement = closeCursor();

}
else {
    echo "Form is invalid";
}
?>

</body>

</html>


