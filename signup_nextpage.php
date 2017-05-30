<?php 
$usernameVal=$_REQUEST["username"];
//$passwordVAl=$_REQUEST["password"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else
{
$escapedPW = mysqli_real_escape_string($conn,$_REQUEST['password']);
# generate a random salt to use for this account
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW =  $escapedPW . $salt;
///sha256 is a hashing algorithm
$hashedPW = hash('sha256', $saltedPW); 
    
    $sql="INSERT INTO accounttb(username,password,salt) 
 value('$usernameVal','$hashedPW','$salt')";
    $result=$conn->query($sql);
    if($result==true)
        echo "<h2>Hello $usernameVal !</h2>";
    else
        echo "user insertion error";
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Password Basic Exam</title>
 <meta charset="utf-8">
 <meta name="userform" content="basic-exam">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
 <link rel="stylesheet" type="text/css" href="css/style.css ">
</head>
<body>
  <div class = "container">
    <form class="form-signin" name="loginform" action="logout.php" method="post" > 
    <button class="btn btn-lg btn-success btn-block" type="submit" name="submit">Logout</button>
  </form>
  </div>

  <!-- Script Section -->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src = "js/bootstrap.js"></script>
<!-- End of Script Section -->

</body>
</html> 
