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
  <h2>Please Create Account</h2>
  <form class="form-signin" name="loginform" action="signup_nextpage.php" method="post" > 
  <input class="form-control" type="text" name="username" placeholder="enter username" required>
  <input class="form-control" type="password" id="passwordID" name="password" placeholder="enter password" minlength="5" required>
  <input class="form-control" type="password" name="cpassword" placeholder="enter confirm password" minlength="5" oninput="check(this)" required>
  <div class="checkbox">
  <label><input type="checkbox" value="remember-me"> Remember me</label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
</form>
</div>

<!-- For Password Matching Validation -->
<script type="text/javascript">
function check(input) {
if (input.value != document.getElementById('passwordID').value) {
input.setCustomValidity('Password Must be Matching.');
} 
else {
// input is valid -- reset the error message
input.setCustomValidity('');
}
}
</script>
<!-- End Password Matching Validation -->

<!-- Script Section -->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src = "js/bootstrap.js"></script>
<!-- End of Script Section -->

</body>
</html>