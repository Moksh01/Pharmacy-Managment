<?php
include_once("../db_connection.php");

if(isset($_POST["submit"])) {
    $id = $_POST["distributorID"];
    $name = $_POST["distributorName"];
    $address = $_POST["distributorAddress"];
    $phone = $_POST["distributorPhone"];

    $query = "UPDATE distributors SET d_name='$name', d_address='$address', d_phone='phone' WHERE d_id='$id' ";
    if(mysqli_query($conn, $query)) {
        echo "Your data has been saved into the database";
        header("refresh:2,url=../pages/distributors.php");
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
  <title>Distributor Information Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="../styles/style2.css" />
</head>
<body>
<h1>Distributor Information</h1>

  <form action="d_update.php" method="post" class="customer-form">
    <div class="form-row">
      <label for="distributoID">Distributor ID:</label>
      <input type="text" id="distributorID" name="distributorID" required>
    </div>
    <div class="form-row">
      <label for="distributorName">Distributor Name:</label>
      <input type="text" id="distributorName" name="distributorName" required>
    </div>
    <div class="form-row">
      <label for="distributorAddress">Distributor Address:</label>
      <textarea id="distributorAddress" name="distributorAddress" rows="4" cols="50" required></textarea>
    </div>
    <div class="form-row">
      <label for="distributorPhone">Distributor Phone Number:</label>
      <input type="tel" id="distributorPhone" name="distributorPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="XXX-XXX-XXXX" required>
    </div>
    <button type="submit" name="submit">Submit</button>
  </form>

</body>
</html>
