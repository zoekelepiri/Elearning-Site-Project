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
    $do = "DELETE FROM homework WHERE id=".$_GET['id'];
    $query = mysqli_query($conn,$do);
    header("Location: homework.php");
  }
}
$role = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Εργασίες</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php
  $header = "Εργασίες";
  include "header.php";
  ?>

  <div class="mainText">
  <form action="homework.php" method="POST" style="float:right">
      <input id="signInBtn" type="submit" name="logoutBtn" value="Log-out" />
    </form>
    <?php
    include "includes/dataBase.php";
    $do = "SELECT * FROM homework";
    mysqli_set_charset($conn, "utf8");
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);

    if($role=="Tutor"){
      ?><h3><a href = "add/addHomeWork.php">Add new project</a></h3><hr><?php
    }
    $_SESSION['table'] = "homework";
    $_SESSION['oPath'] = "homework";
    $counter=0;
    do {
      $counter++;
      $id = $results['id'];
      $goal = $results['goal'];
      $description = $results['description'];
      $submit = $results['submit'];
      $date = $results['endDate'];

      ?>
      <div class="homework">
        <h2>Εργασία <?php echo $counter ?></h2>
        <?php
        if($role=='Tutor'){
          ?><h4><a href = "edit/editHomeWork.php?id=<?php echo $id?>">Edit</a> | <a href = "homework.php?id=<?php echo $id?>">Delete</a></h4><?php
        }
        ?>
        <p>
          <i>Στόχοι: Οι στόχοι της εργασίας είναι </i><br>
          <ol>
            <?php echo $goal ?> <br>
          </ol>
          <i>Εκφώνηση:</i><br><p style="text-indent :3em;" >Κατεβάστε την εκφώνηση της εργασίας <a href=<?php echo $description?> download>download</a></p>

          <i>Παραδοτέα: </i>
          <ol>
            <?php echo $submit ?> <br>
          </ol>
          <span><b>Ημερομηνία παράδοσης</b>: <?php echo $date ?></span>
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
