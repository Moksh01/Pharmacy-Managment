<?php

include_once("../db_connection.php");
if(isset($_POST["submit"])) {
    $billNumber = $_POST["billNumber"];
    
    $historyquery="DELETE FROM history WHERE Bill_number='$billNumber'";
    if(!mysqli_query($conn,$historyquery)){
      echo "Error deleting the bill from database";
    }

    // SQL to delete a record
    $query = "DELETE FROM bill_details WHERE Bill_number='$billNumber'";

    // Your database query execution code here
    if(mysqli_query($conn, $query)) {
        echo "Your bill has been deleted from the database";
        header("refresh:2,url=../pages/bills.php");
        exit; // Exiting after header redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    // Your database connection closing code here
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="../styles/style2.css" />
  <title>Delete Bill Form</title>
</head>
<body>
  <h1>Delete Bill</h1>
  <form action="b_delete.php" method="post" class="customer-form">
    <label for="billNumber">Enter Bill Number to Delete:</label>
    <input type="text" id="billNumber" name="billNumber" required>
    <button type="submit" name="submit">Delete Bill</button>
  </form>
</body>
</html>
