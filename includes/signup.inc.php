<?php 

if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
    $first = mysqli_real_escape_string($connection, $_POST['first']);
    $last = mysqli_real_escape_string($connection, $_POST['last']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $uid = mysqli_real_escape_string($connection, $_POST['uid']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //ERROR HANDLERS
    //Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($password)) {
      header("Location: ../signup.php?signup=empty");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z]*$/", $first) || (!preg_match("/^[a-zA-Z]*$", $last)) {
        header("Location: ../signup.php?signup=invalid");
        exit();
      } else {
        //Check if email is valid 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=email");
        exit();
        } else {
          $sql = "SELECT * FROM users WHERE user_uid='$uid";
          $results = mysqli_query($connection, $sql);
          $resultCheck = msqli_num_row($result);

          if ($resultCheck > 0 ) {
            header("Location: ../signup.php?signup=usertaken");
            exit();
          } else {
            //Hasing the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            //Insert the user into the database
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_password) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
            $results = msqli_query($connection, $sql);
            header("Location: ../signup.php?signup=success");
            exit();
          }
        }
      }
    }

} else {
    header("Location: ../signup.php");
    exit();
}