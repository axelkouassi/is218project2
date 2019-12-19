<?php

require ('pdo.php');

// Getting user's id, first name, and last name from display_login.php
$id = filter_input(INPUT_GET,'userID');
$firstName = filter_input(INPUT_GET,'fname');
$lastName = filter_input(INPUT_GET,'lname');

// Getting input data from users on question form
$question_name = filter_input(INPUT_POST,'question_name');
$question_body = filter_input(INPUT_POST,'question_body');
$question_skills = filter_input(INPUT_POST,'question_skills');

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
    <title>Questions Form</title>

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
        <a href="questions.php"class ="right_align">Questions</a>
        <a href="register.html"class ="right_align">Register</a>
        <a href="login.html" class ="right_align">Login</a>
    </nav>
</div>


<main>
    <form action="display_questions.php?&userID=<?php echo $id ?>&fname=<?php echo $firstName ?>&lname=<?php echo $lastName ?>" method="post" class ="form">

        <h1>New Question Form</h1>
        <p style="color: red; ">* Required Fields</p><br>
        <div id="login_data">
            <div class="form-group">
                <label for="question_name">Question Name</label><span style="color: red; ">*</span><br>
                <input type="text" name="question_name" class="form-control" id="question_name">
            </div><br>

            <div class="form-group">
                <label for="question_body">Question Body</label><span style="color: red; ">*</span><br>
                <textarea type="text" name="question_body" class="form-control" id="question_body" rows="5"></textarea>
            </div><br>

            <div class="form-group">
                <label for="question_skills">Questions Skills</label><span style="color: red; ">*</span><br>
                <input type="text" name="question_skills" class="form-control" id="question_skills">
                <p style="color: red; ">Enter at least 2 skills, separated by a comma.</p><br>
            </div>

        </div>

        <div id="login_button">
            <label>&nbsp;</label>
            <input type="submit" class="btn btn-default btn-block" value ="Submit Question"><br>
        </div>

        <?php


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
            header('location: login.html');

        }
        ?>

    </form>
</main>

</body>

</html>



