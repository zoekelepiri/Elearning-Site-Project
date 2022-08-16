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
    $do = "DELETE FROM documents WHERE id=".$_GET['id'];
    $query = mysqli_query($conn,$do);
    header("Location: documents.php");
  }
}

$role = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Έγγραφα</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
  $header = "Έγγραφα";
  include "header.php";
  ?>
  <div class="mainText">
  <form action="documents.php" method="POST" style="float:right">
      <input id="signInBtn"
      type="submit" name="logoutBtn" value="Log-out" />
    </form>
    <?php
    include "includes/dataBase.php";
    $do = "SELECT * FROM documents";
    mysqli_set_charset($conn, "utf8");
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);

    if($role=="Tutor"){
      ?><h3><a href = "add/addDocument.php">Add new document</a></h3><hr><?php
    }
    $_SESSION['table'] = "documents";
    $_SESSION['oPath'] = "documents";
    do {
      $id = $results['id'];
      $path = $results['path'];
      $subject = $results['docTitle'];
      $text = $results['description'];

      ?>
      <h2><?php echo $subject ?></h2>
      <?php
        if($role=='Tutor'){
          ?><h4><a href = "edit/editDocument.php?id=<?php echo $id?>">Edit</a> | <a href = "documents.php?id=<?php echo $id?>">Delete</a></h4><?php
        }
        ?>
      <div class="documents">
        <p>
        <i>Περιγραφή: </i><?php echo $text ?> <br>
        <a href=<?php echo $path?> download>download</a>
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
