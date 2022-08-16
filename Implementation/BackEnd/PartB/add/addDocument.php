<?php
session_start();
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
} else {
    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    if (isset($_POST['submit-doc'])) {
        $title = $_POST['title'];
        $text = $_POST['docText'];
        $path = $_POST['path'];
        mysqli_set_charset($conn, "utf8");
        $do = "INSERT INTO documents (doctitle,description,path) VALUES ('" . mysqli_real_escape_string($conn, $title) . "','" . mysqli_real_escape_string($conn, $text) . "','" . mysqli_real_escape_string($conn, $path) . "')";
        $query = mysqli_query($conn, $do);
        header("Location: ../documents.php");
    } else if (isset($_POST['cancel-doc'])) {
        header("Location: ../documents.php");
    }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
<center>
    <div style="padding-top:10%">
        <form action="addDocument.php" method="post" id="docForm">

            <h3>Δημιουργία νέου εγγράφου</h3>
            Όνομα αρχείου: <input type="text" name="path"><br>
            Τίτλος: <input type="text" name="title"><br>
            Περιγραφή<br>
            <textarea name="docText" form="docForm" style="height:100px"></textarea><br>
            <input type="submit" name="submit-doc" value="Submit">
            <input type="submit" name="cancel-doc" value="Cancel">
        </form>
    </div>
</center>
