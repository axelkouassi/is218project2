<?php
// Getting input data from users
$question_name = filter_input(INPUT_POST,'question_name');
$question_body = filter_input(INPUT_POST,'question_body');
$question_skills = filter_input(INPUT_POST,'question_skills',
                                FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);

//Declaring and initializing variable to store question name and question body length
$question_name_length = strlen($question_name);
$question_body_length = strlen($question_body);

//Convert string to a comma and space separated array
$question_skills_String = implode($question_skills, ', ');

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
//Skills validation - At Least 2 skills must be entered
else if (sizeof($question_skills) < 2){
    $question_skills = 'You must enter at least 2 skills!';
}
else {
    $question_skills = filter_input(INPUT_POST,'question_skills');
}

// Validation if string is null
if($question_skills_String == NULL){
    $question_skills_String = 'Question Skills is required! Cannot Be Empty!';
}
else if((stripos($question_skills_String,', ')) === false){
    $question_skills_String = 'You must enter at least 2 skills!';
}
else {
    $question_skills_String;
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
    <!-- <label>Question Skills (Array): </label> -->
    <!--<span></*?php /*echo print_r($question_skills); ?></span><br> -->
    <!-- <label>Question Skills (String): </label> -->
    <!-- <span></*?php echo print_r($question_skills); ?*/></span><br> -->
    <span><?php echo $question_skills_String; ?></span><br>
</main>
</body>
</html>
