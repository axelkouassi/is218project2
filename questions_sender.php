<?php

require ('pdo.php');
// Getting input data from users
$question_name = filter_input(INPUT_POST,'question_name');
$question_body = filter_input(INPUT_POST,'question_body');
$question_skills = filter_input(INPUT_POST,'question_skills');

header("Location: display_questions.php?question_name=$question_name&question_body=$question_body&question_skills=$question_skills");

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
    $question_body = filter_input(INPUT_POST,'question_body');
}


//Question Skills Emptiness Validation
if(empty($question_skills)){
    $question_skills = 'Question Skills is required! Cannot Be Empty!';
}
else if(sizeof($question_skills_array) < 2){
    $question_skills = 'Please enter at least 2 skills!';
}
// Adding validation requiring skill after each comma so user can't only put comma and the empty space will be considered a skill
else if($question_skills_array){
    for ($i = 0; $i <  sizeof($question_skills_array); $i++){
        if ($question_skills_array[$i] == ''){
            $question_skills = 'Please enter a skill after each comma!';
        }
    }
}

else {
    $question_skills;
}

?>

<!--Display Data after validation-->
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
    <title>Display of User's Questions</title>

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


<div class = "display">
    <main>
        <h1>Displaying of User's Questions</h1>

        <label>Question Name: </label>
        <span><?php echo htmlspecialchars($question_name); ?></span><br>

        <label>Question Body: </label>
        <span><?php echo htmlspecialchars($question_body); ?></span><br>

        <label>Question Skills Answer: </label>
        <span><?php echo $question_skills; ?></span><br>  <!-- Comments displaying data validation errors -->

    </main>

    <?php
    // Testing database
    if (strlen($question_name) >=3){

        // SQL Query
        $query = 'INSERT INTO questions
          (title, body, skills)
          VALUES
          (:title, :body, :skills)';

        //Create PDO Statement
        $statement = $db->prepare($query);

        //Bind Form Values to SQL
        $statement -> bindValue(':title', $question_name);
        $statement -> bindValue(':body', $question_body);
        $statement -> bindValue(':skills', $question_skills);


        //Execute the SQL Query
        $statement->execute();

        //Close the database connection
        $statement = closeCursor();

        header("Location: display_questions.php");
        //?question_name=$question_name&question_body=$question_body&question_skills=$question_skills

// Receiving data
        /*$question_name = filter_input(INPUT_GET,'question_name');
        $question_body = filter_input(INPUT_GET,'question_body');
        $question_skills = filter_input(INPUT_GET,'question_skills');*/

    }
    else {
        echo "Form is invalid";
    }


    ?>


</body>

</html>

