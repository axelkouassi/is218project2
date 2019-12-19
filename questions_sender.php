<?php

require ('pdo.php');
// Getting user's id, first name, and last name from display_login.php
$id = filter_input(INPUT_GET,'userID');
$firstName = filter_input(INPUT_GET,'fname');
$lastName = filter_input(INPUT_GET,'lname');

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


if ($id){

// Writing questions to database
// SQL Query
$query = 'INSERT INTO questions (ownerid, title, body, skills)
    VALUES (:userID, :title, :body, :skills)';
//Create PDO Statement
$statement = $db->prepare($query);
//Bind Form Values to SQL
$statement -> bindValue(':title', $question_name);
$statement -> bindValue(':body', $question_body);
$statement -> bindValue(':skills', $question_skills);
$statement -> bindValue(':userID', $id);
//Execute the SQL Query
$statement->execute();
//Close the database connection
$statement = closeCursor();

header("Location: display_questions.php?userID=$id%fname=$firstName&lname=$lastName");
}

else {
    header("Location: questions.php?userID=$id%fname=$firstName&lname=$lastName");
}