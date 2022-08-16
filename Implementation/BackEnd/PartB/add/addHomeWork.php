<?php
session_start();
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
} else {
    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    if (isset($_POST['submit-hw'])) {
        $path = $_POST['path'];
        $goals = $_POST['goals'];
        $submits = $_POST['submits'];
        $date = $_POST['date'];
        mysqli_set_charset($conn, "utf8");
        $do = " INSERT INTO homework (goal,description,submit,endDate) VALUES ('" . mysqli_real_escape_string($conn, $goals) . "','" . mysqli_real_escape_string($conn, $path) . "','" . mysqli_real_escape_string($conn, $submits) . "','" . mysqli_real_escape_string($conn, $date) . "')";
        $query = mysqli_query($conn, $do);
        $topic = "Ανακοινώθηκε νέα εργασία";
        $aText = "Η ημερομηνία παράδοσης της εργασίας είναι: " . $_POST['date'];
        $date =  date("y-m-d");
        $do = "INSERT INTO announcements (subject,annText,annDate) VALUES ('" . mysqli_real_escape_string($conn, $topic) . "','" . mysqli_real_escape_string($conn, $aText) . "','" . mysqli_real_escape_string($conn, $date) . "')";
        mysqli_set_charset($conn, "utf8");
        $query = mysqli_query($conn, $do);

        header("Location: ../homework.php");
    } else if (isset($_POST['cancel-hw'])) {
        header("Location: ../homework.php");
    }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
<center>
    <div style="padding-top:10%">
        <form action="addHomeWork.php" method="post" id="hwForm">
            <h3>Δημιουργία νέας εργασίας</h3>
            Τίτλος αρχείου εκφώνησης: <input type="text" name="path"><br>
            Ημερομηνία παράδοσης: <input type="text" name="date"><br>
            Στόχοι<br>
            <textarea name="goals" form="hwForm" style="height:100px"></textarea><br>
            Παραδοτέα<br>
            <textarea name="submits" form="hwForm" style="height:100px"></textarea><br>
            <input type="submit" name="submit-hw" value="Submit">
            <input type="submit" name="cancel-hw" value="Cancel">
        </form>
    </div>
</center>
