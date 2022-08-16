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
if(isset($_GET['id'])){
  if ($_GET['id']>0) {
    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    $do = "DELETE FROM announcements WHERE id=".$_GET['id'];
    $query = mysqli_query($conn,$do);
    header("Location: announcement.php");
  }
}
$role = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Ανακοινώσεις</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php
  $header = "Ανακοινώσεις";
  include "header.php";
  ?>

  <div class="mainText">
  <form action="announcement.php" method="POST" style="float:right">
      <input id="signInBtn" type="submit" name="logoutBtn" value="Log-out" />
    </form>
    <?php
    include "includes/dataBase.php";
    $do = "SELECT * FROM announcements";
    mysqli_set_charset($conn, "utf8");
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);

    if($role=="Tutor"){
      ?><h3><a href = "add/addAnnouncement.php">Add new announcement</a></h3><hr><?php
    }

    $_SESSION['table'] = "announcements";
    $_SESSION['oPath'] = "announcement";
    $counter=0;
    do {
      $counter++;
      $_SESSION['id'] = $results['id'];
      $date = $results['annDate'];
      $subject = $results['subject'];
      $text = $results['annText'];
      $id = $_SESSION['id'];
      ?>
      <h2>Ανακοίνωση
      <?php
      echo $counter;

      if($role=='Tutor'){
        ?><h4><a href = "edit/editAnnouncement.php?id=<?php echo $id?>">Edit</a> | <a href = "announcement.php?id=<?php echo $id?>">Delete</a></h4><?php
      }
      ?></h2>
      <div class="announcement">
        <p>
          <strong>Ημερομηνία: </strong><?php echo $date ?><br>
          <strong>Θέμα: </strong><?php echo $subject ?><br>
          <?php echo $text ?><br>
          <hr>
        </p>
      </div>
    <?php
  } while ($results = mysqli_fetch_assoc($query))
    ?>
    <a href="#top" style="float: right;">top</a>

  </div>

</body>

</html>
