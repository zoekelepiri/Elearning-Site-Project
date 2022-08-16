<?php
session_start();
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
} else {
    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    $id = $_GET['id'];
    mysqli_set_charset($conn, "utf8");
    $do = "SELECT * FROM announcements WHERE id=" . $id;
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);
    $subject = $results['subject'];
    $text = $results['annText'];
}
if (isset($_POST['submit-announcement'])) {
    $subject = $_POST['topic'];
    $text = $_POST['annText'];
    $date = date("y-m-d");
    $do = "UPDATE announcements SET subject='" . $subject . "',anntext='" . $text . "',anndate='" . $date . "' WHERE id='" . $id . "'";
    $query = mysqli_query($conn, $do);
    header("Location: ../announcement.php");
} else if (isset($_POST['cancel-announcement'])) {
    header("Location: ../announcement.php");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
<center>
    <div style="padding-top:10%">
        <form action="editAnn.php?id=<?php echo $id ?>" method="post" id="annForm">
            <h3>Επεξεργασία ανακοίνωσης</h3>
            Θέμα: <input type="text" name="topic" value=<?php echo $subject ?>><br>
            Περιεχόμενο<br>
            <textarea name="annText" form="annForm" style="height:100px"><?php echo $text ?></textarea><br>
            <input type="submit" name="submit-announcement" value="Submit">
            <input type="submit" name="cancel-announcement" value="Cancel">
        </form>
    </div>
</center>
