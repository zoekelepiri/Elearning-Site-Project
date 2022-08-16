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
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="Content-Language" content="el">
      <title>Αρχική Σελίδα</title>
      <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>

      <header class="mainHead">
        <h1>Αρχική Σελίδα</h1>
      </header>

      <div class="menuBar">
        <a href="index.php"><img src="index.jpg" alt="index" width=200px></a> <br>
        <a href="announcement.php"><img src="announcement.jpg" alt="announcement" width=200px></a> <br>
        <a href="communication.php"><img src="communication.jpg" alt="communication" width=200px></a> <br>
        <a href="documents.php"><img src="documents.jpg" alt="documents" width=200px></a> <br>
        <a href="homework.php"><img src="homework.jpg" alt="homework" width=200px></a> <br>
      </div>

      <div class="mainText">

        <p>Καλώς ήρθατε στην ιστοσελίδα του μαθήματος <strong>HTML For Beginners</strong>.
          <br>
          Στόχος του μαθήματος είναι η εκμάθηση της γλώσσας HTML σε αρχάριους ώστε να μπορούν να σχεδιάσουν τη δική τους ιστοσελίδα.
          <br>
          Όπως φαίνεται από τις επιλογές του μενού, στη σελίδα μπορείτε να βρείτε:
        </p>

        <ul class="list">
          <li>Ανακοινώσεις: Όπου θα αναρτώνται ενημερώσεις που αφορούν τις εξελίξεις ή αλλαγές του μαθήματος</li>
          <li>Επικοινωνία: Προκειμένου να επικοινωνίσετε με τον καθηγητή ή τους βοηθούς του μαθήματος</li>
          <li>Εργασίες: Εδώ θα αναρτάται οτιδήποτε αφορά τις εργασίες του μαθήματος αλλά και θα παρέχετε η δυνατότητα στον μαθητή για να επισυνάψει τις δικές του εργασίες</li>
          <li>Έγγραφα: Όπου ο χρήστης θα μπορεί να βρει και να κατεβάσει αρχεία σχετικά με το μάθημα</li>
        </ul>

        <img src="index.png"class="center" alt="image not found" width=300px id="image1">

      </div>

  </body>
</html>
