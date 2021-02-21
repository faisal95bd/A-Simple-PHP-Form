<?php

define("REQUIRED_FIELD_ERROR", "This field is required!");
$errors = [];
$userName = "";
$email = "";
$password = "";
$repPassword = "";
$cvUrl = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $userName = postData("userName");
  $email = postData("email");
  $password = postData("password");
  $repPassword = postData("repPassword");
  $cvUrl = postData("cvUrl");

  // echo "<pre>";
  // var_dump($userName, $email, $password, $repPassword, $cvUrl);
  // echo "</pre>";

  if (!$userName) {
    $errors["userName"] = REQUIRED_FIELD_ERROR;
  } elseif (strlen($userName) < 5 || strlen($userName) > 20) {
    $errors["userName"] = "This field must be minimum 5 & maximum 20 charecters!";
  }
  if (!$email) {
    $errors["email"] = REQUIRED_FIELD_ERROR;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo $errors["email"] = "The email address isn't valid";
  }
  if (!$password) {
    $errors["password"] = REQUIRED_FIELD_ERROR;
  }
  if (!$repPassword) {
    $errors["repPassword"] = REQUIRED_FIELD_ERROR;
  }
  if ($password && $repPassword && strcmp($password, $repPassword) !== 0) {
    $errors["repPassword"] = "The passwords don't match!";
  }
  // if (!$cvUrl) {
  //   $errors["cvUrl"] = REQUIRED_FIELD_ERROR;
  // }
  if ($cvUrl && !filter_var($cvUrl, FILTER_VALIDATE_URL)) {
    $errors["cvUrl"] = "The url is not valid!";
  }
}

function postData($field) {
  $_POST[$field]??="";
  return htmlspecialchars(stripslashes($_POST[$field]));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Registration Form</title>

  <style>
  body {
    padding: 20px
  }
  .form-group {
    padding: 8px;
  }
  </style>
</head>
<body>
  <div class="registationForm">
  <form action="" method="post" novalidate>

  <div class="row">
  <div class="col">
  <div class="form-group">
  <label for="">Username</label>
  <input type="text" class="form-control <?php echo isset($errors["userName"]) ? "is-invalid" : ""; ?>" name="userName" id="" value="<?php echo $userName ?>">
  <small>Min 5 & maximum 20 charecters</small>
  <div class="invalid-feedback">
  <?php echo $errors["userName"]??=""; ?>
  </div>
  </div>
  </div>
  <div class="col">
  <div class="form-group">
  <label for="">Email</label>
  <input type="email" class="form-control <?php echo isset($errors["email"]) ? "is-invalid" : ""; ?>" name="email" id="" value="<?php echo $email ?>">
  <div class="invalid-feedback">
  <?php echo $errors["email"]??=""; ?>
  </div>
  </div>
  </div>
  </div>

  <div class="row">
  <div class="col">
  <div class="form-group">
  <label for="">Password</label>
  <input type="password" class="form-control <?php echo isset($errors["password"]) ? "is-invalid" : ""; ?>" name="password" id="" value="<?php echo $password ?>">
  <div class="invalid-feedback">
  <?php echo $errors["password"]??=""; ?>
  </div>
  </div>
  </div>
  <div class="col">
  <div class="form-group">
  <label for="">Repeat Password</label>
  <input type="password" class="form-control <?php echo isset($errors["repPassword"]) ? "is-invalid" : ""; ?>" name="repPassword" id="" value="<?php echo $repPassword ?>">
  <div class="invalid-feedback">
  <?php echo $errors["repPassword"]??=""; ?>
  </div>
  </div>
  </div>
  </div>

<div class="form-group">
<label for="">Your CV Link</label>
<input type="text" class="form-control <?php echo isset($errors["cvUrl"]) ? "is-invalid" : ""; ?>" name="cvUrl" id="" placeholder="https://example.com/my-cv" value="<?php echo $cvUrl ?>">
  <div class="invalid-feedback">
  <?php echo $errors["cvUrl"]??=""; ?>
  </div>
</div>

<div class="form-group">
<button class="btn btn-primary">Register</button>
</div>

  </form>

  </div>
</body>
</html>