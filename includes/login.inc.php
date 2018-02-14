<?php 

session_start();

if (isset($_POST['submit'])) {
  include 'dbh.inc.php';
  $uid = mysqli_real_escape_string($connection, $_POST['uid']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  //Error handlers
  //Check if inputs are empty
  if (empty($uid || empty($password)) {
    header("Location: ../index.php?login=emptyr")
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email = '$uid'";
    $results = mysquli_query($connection, $sql);
    $resultCheck = mysqli_num_rows($results);
    if ($resultCheck < 1 ) {
      header("Location: ../index.php?login=error")
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
        //De-hasing the password
        $hashedPwdCheck = password_verify($password, $row['user_password']);
        if ($hashedPwdCheck == false) {
          header("Location: ../index.php?login=error")
          exit(); 
        } elseif ($hashedPwdCheck == true) {
          //Lock in the user here
          $_SESSION['u_id'] = $row['user_id'];
          $_SESSION['u_first'] = $row['user_first'];
          $_SESSION['u_last'] = $row['user_last'];
          $_SESSION['u_email'] = $row['user_email'];
          $_SESSION['u_uid'] = $row['user_uid'];
          header("Location: ../index.php?login=success")
          exit();
        }
      }
    }
  }
} else {
  header("Location: ../index.php?login=error")
  exit();
}