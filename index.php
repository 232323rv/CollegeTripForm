<?php
$insert = false;

if (isset($_POST['name'])) {

  $server   = "127.0.0.1";
  $username = "root";
  $password = "";
  $database = "trip";   // <<< CHANGE to your real database name

  // Connect to database
  $con = mysqli_connect($server, $username, $password, $database);

  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Collect POST values
  $name   = $_POST['name']   ?? '';
  $age    = $_POST['age']    ?? '';
  $gender = $_POST['gender'] ?? '';
  $email  = $_POST['email']  ?? '';
  $phone  = $_POST['phone']  ?? '';
  $desc   = $_POST['desc']   ?? '';

  // Insert SQL query
  $sql = "INSERT INTO trip (name, age, gender, email, phone, other, dt)
          VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', CURRENT_TIMESTAMP());";

  // Execute query
  if ($con->query($sql) === TRUE) {
    $insert = true;
  } else {
    echo "ERROR: $sql <br>" . $con->error;
  }

  // Close connection
  $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Travel Form</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Sriracha&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <img class="bg" src="cuk2.jpg" alt="CUK">

  <div class="container">
     <h1>Welcome to Central University of Karnataka College Trip Form.</h1>
     <p>Enter your details and submit this form to confirm your participation in the trip.</p>

     <!-- Success message -->
     <?php
     if ($insert == true) {
         echo "<p class='submitmsg'>Thanks for submitting your form. We are happy to see you joining us for College Trip</p>";
     }
     ?>

     <!-- Form -->
     <form action="index.php" method="post">

      <input type="text" name="name" id="name" placeholder="Enter your full name" required>
      <input type="text" name="age" id="age" placeholder="Enter your age" required>
      <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
      <input type="text" name="email" id="email" placeholder="Enter your email id" required>
      <input type="text" name="phone" id="phone" placeholder="Enter your phone no." required>

      <!-- Correct textarea name -->
      <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>

      <button class="btn">Submit</button>

      <!-- Reset button - reloads form -->
      <button type="button" class="btn" onclick="window.location.href='index.php'">Reset</button>

    </form>
  </div>

  <script src="index.js"></script>
</body>
</html>
