<?php

require ('pdo.php');
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

//Display User's First and Last Name

// Getting input data from users
$email_address = filter_input(INPUT_GET,'email_address');
$password = filter_input(INPUT_GET,'password');
$id = filter_input(INPUT_GET,'userID');
$firstName = filter_input(INPUT_GET,'fname');
$lastName = filter_input(INPUT_GET,'lname');

$name = filter_input(INPUT_GET,'qname');
$body = filter_input(INPUT_GET,'qbody');
$skills = filter_input(INPUT_GET,'qskills');


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

        <!--<label>Question Name: </label>
        <span></?php echo htmlspecialchars($question_name); ?></span><br>

        <label>Question Body: </label>
        <span></?php echo htmlspecialchars($question_body); ?></span><br>

        <label>Question Skills Answer: </label>
        <span></?php echo $question_skills; ?></span><br>  // Comments displaying data validation errors--> <!-- Comments displaying data validation errors -->

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
    </div>

    <br>
    <a href="questions.html&userId=<?php echo $id ?>" class="btn btn-default btn-block">Add Questions</a>
    <a href="questions.html" class="btn btn-default btn-block">Add Questions</a>
</div>



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

}
else {
    echo "Form is invalid";
}

    // Function to get question name
    function get_qname($question_name, $question_body, $question_skills) {
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE title = :qname AND body = :body AND skills = :skills';
    //Create PDO Statement
    $statement = $db->prepare($query);

    //Bind Form Values to SQL
    $statement->bindValue(':qname', $question_name);
    $statement->bindValue(':body', $question_body);
    $statement->bindValue(':skills', $question_skills);

    //Execute the SQL Query
    $statement->execute();

    //Fetch All data
    $question = $statement->fetchAll();

    $isValidLogin = count($question) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $name = $question['title'];
        $statement->closeCursor();
        return $name;
    }
    }

    // Function to get question body
    function get_qbody($question_name, $question_body, $question_skills) {
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE title = :qname AND body = :body AND skills = :skills';
    //Create PDO Statement
    $statement = $db->prepare($query);

    //Bind Form Values to SQL
    $statement->bindValue(':qname', $question_name);
    $statement->bindValue(':body', $question_body);
    $statement->bindValue(':skills', $question_skills);

    //Execute the SQL Query
    $statement->execute();

    //Fetch All data
    $question = $statement->fetchAll();

    $isValidLogin = count($question) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $body = $question['body'];
        $statement->closeCursor();
        return $body;
    }
    }

    // Function to get question skills
    function get_qskills($question_name, $question_body, $question_skills) {
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE title = :qname AND body = :body AND skills = :skills';
    //Create PDO Statement
    $statement = $db->prepare($query);

    //Bind Form Values to SQL
    $statement->bindValue(':qname', $question_name);
    $statement->bindValue(':body', $question_body);
    $statement->bindValue(':skills', $question_skills);

    //Execute the SQL Query
    $statement->execute();

    //Fetch All data
    $question = $statement->fetchAll();

    $isValidLogin = count($question) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $skills = $question['title'];
        $statement->closeCursor();
        return $skills;
    }
    }

    // Function to get question id
    function get_qid($question_name, $question_body, $question_skills) {
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE title = :qname AND body = :body AND skills = :skills';
    //Create PDO Statement
    $statement = $db->prepare($query);

    //Bind Form Values to SQL
    $statement->bindValue(':qname', $question_name);
    $statement->bindValue(':body', $question_body);
    $statement->bindValue(':skills', $question_skills);

    //Execute the SQL Query
    $statement->execute();

    //Fetch All data
    $question = $statement->fetchAll();

    $isValidLogin = count($question) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $qID = $question['id'];
        $statement->closeCursor();
        return $qID;
    }
    }

    // Function to get owner id
    function get_ownerID($question_name, $question_body, $question_skills) {
    global $db;
    // SQL Query
    $query = 'SELECT * FROM questions WHERE title = :qname AND body = :body AND skills = :skills';
    //Create PDO Statement
    $statement = $db->prepare($query);

    //Bind Form Values to SQL
    $statement->bindValue(':qname', $question_name);
    $statement->bindValue(':body', $question_body);
    $statement->bindValue(':skills', $question_skills);

    //Execute the SQL Query
    $statement->execute();

    //Fetch All data
    $question = $statement->fetchAll();

    $isValidLogin = count($question) > 0;

    if (!$isValidLogin) {
        $statement->closeCursor();
        return false;
    } else {
        $ownerID = $question['id'];
        $statement->closeCursor();
        return $ownerID;
    }
}


// Checking login info and Redirecting and sending data to display_questions.php
$name = get_qname($question_name, $question_body, $question_skills);
$body = get_qbody($question_name, $question_body, $question_skills);
$skills = get_qskills($question_name, $question_body, $question_skills);
$qID = get_qid($question_name, $question_body, $question_skills);
$ownerID = get_qid($question_name, $question_body, $question_skills);

//if condition to redirect a request if fields are empty
if ($name == false AND $body == FALSE || $skills == FALSE){
    header('location: register.html');
}
else {
    //Redirect to display_questions.php if login is true
    header("location: display_questions.php?qname=$name &qbody=$body&qskills=$skills&qID=$qID&ownerID=$ownerID");
}
?>
</body>
</html>
