<?php

require ('pdo.php');

//Display User's First and Last Name
// Getting input data from users from display_login.php
$id = filter_input(INPUT_GET,'userID');
$firstName = filter_input(INPUT_GET,'fname');
$lastName = filter_input(INPUT_GET,'lname');


// Getting input data from users on question form
$question_name = filter_input(INPUT_POST,'question_name');
$question_body = filter_input(INPUT_POST,'question_body');
$question_skills = filter_input(INPUT_POST,'question_skills');


    //SQL to Display all user's questions
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE ownerID = :ownerID';
    //Create PDO Statement
    $statement = $db->prepare($query);
    //Bind Form Values to SQL
    $statement->bindValue(':ownerID', $id);
    //Execute the SQL Query
    $statement->execute();
    //Fetch All data
    $questions = $statement->fetchAll();
    $isValidLogin = count($questions) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $statement->closeCursor();
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
        <a href="questions.php"class ="right_align">Questions</a>
        <a href="register.html"class ="right_align">Register</a>
        <a href="login.html" class ="right_align">Login</a>
    </nav>
</div>


<div class = "display">
    <main>
        <h1>Displaying of User's Questions</h1>

        <!-- Displaying User's First and Last Name -->
        <label>First Name: </label>
        <span><?php echo $firstName; ?></span><br>

        <label>Last Name: </label>
        <span><?php echo $lastName; ?></span><br>

    </main>

    <!-- Display Questions -->
    <h1>Questions</h1>
    <div>
        <table>
            <tr>
                <th>Question Name</th>
                <th>Body</th>
                <th>Skills</th>
            </tr>
            <?php foreach($questions as $question) : ?>
                <tr>
                    <td><?php echo $question['title']; ?></td>
                    <td><?php echo $question['body']; ?></td>
                    <td><?php echo $question['skills']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>

    </div>

    <!-- Link to get to question form with additional data being sent about userID, first name and last name -->
    <a href="questions.php?userID=<?php echo $id ?>&fname=<?php echo $firstName ?>&lname=<?php echo $lastName ?>" class="btn">Add Questions</a>


</div>


</body>
</html>

