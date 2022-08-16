<?php
session_start();
$conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    if (isset($_POST['submit-announcement'])) {
        $topic = $_POST['topic'];
        $aText = $_POST['annText'];
        $date = date("y-m-d");
        mysqli_set_charset($conn, "utf8");
        $do = "INSERT INTO announcements (subject,annText,annDate) VALUES ('" . mysqli_real_escape_string($conn, $topic) . "','" . mysqli_real_escape_string($conn, $aText) . "','" . mysqli_real_escape_string($conn, $date) . "')";
        $query = mysqli_query($conn, $do);
        header("Location: ../announcement.php");
    } else if (isset($_POST['cancel-announcement'])) {
        header("Location: ../announcement.php");
    }
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
}
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
    <center>
        <div style="padding-top:10%">
            <form action="addAnnouncement.php" method="post" id="annForm">

                <h3>Δημιουργία νέας ανακοίνωσης</h3>
                Θέμα: <input type="text" name="topic"><br>
                Περιεχόμενο<br>
                <textarea name="annText" form="annForm" style="height:100px"></textarea><br>
                <input type="submit" name="submit-announcement" value="Submit">
                <input type="submit" name="cancel-announcement" value="Cancel">
            </form>

        </div>
    </center>
