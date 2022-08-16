<?php
session_start();
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
} else {
    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    $id = $_GET['id'];
    mysqli_set_charset($conn, "utf8");
    $do = "SELECT * FROM documents WHERE id=" . $id;
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);
    $path = $results['path'];
    $subject = $results['docTitle'];
    $text = $results['description'];
}
if (isset($_POST['submit-document'])) {
    $doctitle = $_POST['doctitle'];
    $text = $_POST['description'];
    $path = $_POST['path'];
    $do = "UPDATE documents SET doctitle='" . $doctitle . "',description='" . $text . "',path='" . $path . "' WHERE id='" . $id . "'";
    mysqli_set_charset($conn, "utf8");
    $query = mysqli_query($conn, $do);
    header("Location: ../documents.php");
} else if (isset($_POST['cancel-document'])) {
    header("Location: ../documents.php");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
<center>

    <div style="padding-top:10%">
        <form action="editDoc.php?id=<?php echo $id ?>" method="post" id="docForm">
            <h3>Επεξεργασία ανακοίνωσης</h3>
            Θέμα: <input type="text" name="doctitle" value=<?php echo $subject ?>><br>
            Περιεχόμενο<br>
            <textarea name="description" form="docForm" style="height:100px"><?php echo $text ?></textarea><br>
            Όνομα Αρχείου: <input type="text" name="path" value=<?php echo $path ?>><br>
            <input type="submit" name="submit-document" value="Submit">
            <input type="submit" name="cancel-document" value="Cancel">
        </form>
    </div>
</center>
