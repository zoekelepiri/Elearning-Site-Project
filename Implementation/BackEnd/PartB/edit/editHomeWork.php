<?php
session_start();
if (!$_SESSION['userRole'] == "tutor") {
    header("Location: ../mainPage.php");
} else {

    $conn = mysqli_connect("webpagesdb.it.auth.gr","zkelepiri","12345","student3290");
    $id = $_GET['id'];
    mysqli_set_charset($conn, "utf8");
    $do = "SELECT * FROM homework WHERE id=" . $id;
    $query = mysqli_query($conn, $do);
    $results = mysqli_fetch_assoc($query);
    $path = $results['description'];
    $goals = $results['goal'];
    $submits = $results['submit'];
    $date = $results['endDate'];
}
if (isset($_POST['submit-hw'])) {
    $path = $_POST['path'];
    $goals = $_POST['goals'];
    $submits = $_POST['submits'];
    $date = date("y-m-d");
    $do = "UPDATE homework SET description='" . $path . "',goal='" . $goals . "',submit='" . $submits . "',enddate='" . $date . "' WHERE id='" . $id . "'";
    $query = mysqli_query($conn, $do);
    header("Location: ../homework.php");
} else if (isset($_POST['cancel-hw'])) {
    header("Location: ../homework.php");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="el">
<center>
    <div style="padding-top:10%">
        <form action="editHW.php?id=<?php echo $id ?>" method="post" id="hwForm">
            Τίτλος αρχείου: <input type="text" name="path" value=<?php echo $path ?>><br>
            Ημερομηνία παράδοσης: <input type="text" name="date" value=<?php echo $date ?>><br>
            Στόχοι<br>
            <textarea name="goals" form="hwForm" style="height:100px"><?php echo $goals ?></textarea><br>
            Παραδοτέα<br>
            <textarea name="submits" form="hwForm" style="height:100px"><?php echo $submits ?></textarea><br>
            <input type="submit" name="submit-hw" value="Submit">
            <input type="submit" name="cancel-hw" value="Cancel">
        </form>
    </div>
</center>
