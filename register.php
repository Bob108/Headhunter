<?php
include 'db.php';
$conn = OpenCon();

if(isset($_POST['submit'])){
$user = htmlentities($_POST['user']);
$email = htmlentities($_POST['email']);
$first = htmlentities($_POST['firstname']);
$last = htmlentities($_POST['lastname']);
$pass = htmlentities($_POST['pass']);
$gender = htmlentities($_POST['gender']);
$dob = htmlentities($_POST['dob']);
$secret = htmlentities($_POST['secretword']);
$hash = password_hash($pass, PASSWORD_DEFAULT);
$h = PASSWORD_DEFAULT;
$sql = "INSERT INTO users(firstname, lastname, email, username, password, gender, dob, secretword)
VALUES ('$first', '$last', '$email', '$user', '$hash', '$gender', '$dob','$secret')";
if ($conn->query($sql) === TRUE) {
     header('Location: login.php');
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="registration-form">
        <div class='fieldset'>
          <legend>Register for an Account <a class="loginbutton" role="button" href="./login.php">Log In</a></legend>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class='row'>
              <label for='firstname'>First Name</label>
              <input type="text" placeholder="First Name" name='firstname' id='firstname' required>
            </div>
            <div class='row'>
              <label for="lastname">Last Name</label>
              <input type="text" placeholder="Last Name" name='lastname' id='lastname' required>
            </div>
            <div class='row'>
              <label for="email">E-mail</label>
              <input type="text" placeholder="E-mail" name='email' required>
            </div>

            <div class='row'>
              <label for='pass'>Password</label>
              <input type="password" placeholder="Enter Password" name='pass' id='pass' required>
            </div>
            <div class='row'>
              <label for='user'>Username</label>
              <input type="text" placeholder="Enter your username" name="user" id='user' required>
            </div>
            <div class='row'>
              <label for="gender">Gender</label><br>
              <input type="radio"  name="gender" value="Male" required> Male
              <input type="radio"  name="gender" value="Female"> Female
            </div>
            <br>
            <div class='row'>
              <label for='dob'>Enter Date of Birth</label>
              <input type="date" placeholder="Enter Date of Birth" name='dob' id='dob' required>
            </div>
            <div class='row'>
              <label for="secretword">Secret Word</label>
              <input type="text" placeholder="Secret Word" name='secretword' id='secretword' required>
            </div>


            <input type="submit" value="Register" name="submit">
          </form>
        </div>
      </div>
  </body>
</html>
