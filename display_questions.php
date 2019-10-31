<?php
// Getting input data from users
$question_name = filter_input(INPUT_POST,'question_name');
$question_body = filter_input(INPUT_POST,'question_body');
$question_skills = filter_input(INPUT_POST,'question_skills');

//Declaring and initializing variable to store question name and question body length
$question_name_length = strlen($question_name);
$question_body_length = strlen($question_body);

//Convert a comma separated string to an array
$question_skills_array = explode(',', $question_skills);

//Checking emptiness validation

//Question Name Emptiness Validation
if(empty($question_name)){
    $question_name = 'Question Name is required! Cannot Be Empty!';
}


//Question Name length validation
else if($question_name_length < 3){
    $question_name = 'Question Name must be at least 3 characters!';
}
else {
    $question_name = filter_input(INPUT_POST,'question_name');
}


//Question Body Emptiness Validation
if(empty($question_body)){
    $question_body = 'Question Body is required! Cannot Be Empty!!';
}
//Question Body length validation
else if($question_body_length > 500){
    $question_body = 'Question Name must be less than 500 characters!';
}
else {
    $password = filter_input(INPUT_POST,'question_body');
}


//Question Skills Emptiness Validation
if(empty($question_skills)){
    $question_skills = 'Question Skills is required! Cannot Be Empty!';
}
else if(sizeof($question_skills_array) < 2){
    $question_skills = 'Please enter at least 2 skills!';
}
else {
    $question_skills;
}

?>


<!--Display Data after validation-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Registration Information</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- Header Menu -->

<nav id="nav_menu">
    <a href="index.html" class="home">Home</a>
    <!--<a href="aboutme.html">About Me</a>-->
    <a href="login.html" class="login_active">Login</a>
    <a href="register.html">Register</a>
    <a href="questions.html">Questions</a>
</nav>

<main>
    <h1>Question Information</h1>
    <label>Question Name: </label>
    <span><?php echo htmlspecialchars($question_name); ?></span><br>

    <label>Question Body: </label>
    <span><?php echo htmlspecialchars($question_body); ?></span><br>

    <label>Question Skills Answer: </label>
    <span><?php echo $question_skills; ?></span><br>
</main>
</body>
</html>
