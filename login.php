<?php
include 'db.php';
$conn = OpenCon();
session_start();
if(isset($_POST['login'])){
$username=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if ($row["username"] == $username) {
      if (password_verify($password,$row["password"])) {
        $_SESSION["user_id"] = $username;
        header('Location:pizza.html');
      }
    }
  }
}
}


?>

<!DOCTYPE html>
<html>
<head>
<title>LoginForm</title>

</head>
<body>
<h3>Login Form</h3>
<form method="POST">
<div class="group">
<label>Username</label><br/>
<input type="text" name="username" class="control" placeholder=" Username "/><br/>
</div>
<div class="form-group">
<label for="password">Password</label><br/>
<input type="password" name="password" class="control"/><br/>
</div>
<br/><br/>
<div class="group">
<button type="submit" name="login" value="login">login</button>
</div>
</form>

</body>
</html>
