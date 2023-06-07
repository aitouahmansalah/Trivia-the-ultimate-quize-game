<?php
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM acounts WHERE email='$email' AND passwords='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        setcookie("email", $row["email"], time()+(3600*24*30), "/");
        setcookie("password", $row["passwords"], time()+(3600*24*30), "/");
        setcookie("id", $row["user_id"], time()+(3600*24*30), "/");
        setcookie("score", $row["score"], time()+(3600*24*30), "/");
        header("Location: http://localhost/livescore/index.php");
        exit();
    } else {
        $message = "Incorrect email or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>
      body{
        background-color: beige;
      }
    </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="../index.php">Trivia</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Sign in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../ranking/index.php">Leaderboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../myacount/my.php">My Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.html">Sign Up</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
    <div class=" container text-center border mt-5" style="width: 40%;">
        <div class="d-flex justify-content-center my-5">
    <form action="../php/signin.php" method="post">
      <h1>Trivia</h1>
      <?php if (isset($message)) { ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php } ?>
        <div class="form-outline mb-4">
          <input type="email" id="form2Example1" value="email" class="form-control" name="email" />
          <label class="form-label" for="form2Example1">Email address</label>
        </div>
        <div class="form-outline mb-4">
          <input type="password" id="form2Example2" value="password" class="form-control" name="password" />
          <label class="form-label" for="form2Example2">Password</label>
        </div>
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
             <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
              <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
          </div>
        <div class="col">
            <a href="#!">Forgot password?</a>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
        <div class="text-center">
          <p>Not a member? <a href="signup.html">Register</a></p>
         
        </div>
      </form>
    </div></div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
