<?php
session_start();
if (!isset($_SESSION['userMail'])) {
  header('Location: index.php');
}
if (isset($_POST['logoutBtn'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
}
$role = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Επικοινωνία</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php
  $header = "Επικοινωνία";
  include "header.php";
  ?>

  <div class="mainText">
  <form action="communication.php" method="POST" style="float:right">
      <input id="signInBtn" type="submit"name="logoutBtn" value="Log-out" />
    </form>
    <p>
      Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή e-mail στον καθηγητή:
    </p>
    <ul class=list>
      <li>Μέσω web φόρμας</li>
      <li>Mε χρήση e-mail διεύθυνσης</li>
    </ul>

    <form action="communication.php" method="post" id="mailForm">
      <h2>Αποστολή e-mail μέσω web φόρμας</h2>
      Αποστολέας: <input type="text" name="sender"><br>
      Θέμα: <input type="text" name="topic"><br>
      Περιεχόμενο:<br>
      <textarea name="text" form="mailForm" style="height:100px"></textarea><br>
      <input type="submit" name="send-mail" value="Send">
    </form>

    <?php
    include "includes/dataBase.php";
    $do = "SELECT email FROM users WHERE users.role='tutor'";
    mysqli_set_charset($conn, "utf8");
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);
    $to = '';
    do {
      $to = $to . ' , ' . $results['email'];
    } while ($results = mysqli_fetch_assoc($query));

    if (isset($_POST['send-mail'])) {
      $headers = "From: " . $_POST['sender'];
      $subject = $_POST['subject'];
      $txt = $_POST['text'];

      mail('poofklats@gmail.com', $subject, $txt, $headers);
      header('Location: communication.php');
    }
    ?>
    <hr>

    <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
    Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <br>
    <a href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a>

  </div>
</body>

</html>
