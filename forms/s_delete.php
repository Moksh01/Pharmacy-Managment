<?php
include_once("../db_connection.php");

if(isset($_POST["submit"])) {
    $id = $_POST["code"];


    $query = "DELETE FROM stock WHERE Code=$id";
    if(mysqli_query($conn, $query)) {
        echo "Your data has been deleted from the database";
        header("refresh:2,url=../pages/stocks.php");
        exit; // Exiting after header redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Data Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="../styles/style2.css" />
  <!-- You can include additional stylesheets or scripts here -->
</head>
<body>
  <h1>Stock Data Form</h1>
  <form action="s_delete.php" method="post" class="customer-form">
    <div class="form-row">
      <label for="code">Code:</label>
      <input type="text" id="code" name="code" required>
    </div>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>