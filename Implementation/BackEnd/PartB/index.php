<?php
if (isset($_POST["sign-in"])) {
  include 'includes/dataBase.php';
  $user = $_POST["username"];
  $pwd = $_POST["password"];
  $do = "SELECT * FROM users WHERE email='" . $user . "'";
  $query = mysqli_query($conn, $do);
  $results = mysqli_fetch_assoc($query);
  if (!($user == NULL || $pwd == NULL)) {
    if ($pwd == $results['password']) {
      session_start();
      $_SESSION['userMail'] = $results['email'];
      $_SESSION['userRole'] = $results['role'];
      header("Location: mainPage.php");
      exit();
    } else {
      header("Location: index.php");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo "Sign In" ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <div class="signin">
    <form action="index.php" method="post">
      <table style="width:100%">
        <tr>
          <th>
            <h3>Sign in</h3>
          </th>
        </tr>
        <tr>
          <th> Email: <input class="signInInput" type="text" name="username"></th>
        </tr>
        <tr>
          <th> Password: <input class="signInInput" type="password" name="password"></th>
        </tr>
        <tr>
          <th><input id="signInBtn" type="submit"  name="sign-in"></th>
        </tr>
      </table>
    </form>


  </div>
</body>

</html>
