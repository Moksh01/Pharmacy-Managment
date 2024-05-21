<?php
include_once("../db_connection.php");

if(isset($_POST["submit"])) {
  $billNumber = $_POST["billNumber"];
  $itemCodes = $_POST["itemCode"];
  $itemNames = $_POST["itemName"];
  $itemQuantities = $_POST["itemQuantity"];
  $itemPrices = $_POST["itemPrice"];
  $finalAmount = $_POST["finalAmount"];
  $paymentMethod = $_POST["paymentMethod"];
  $customID = $_POST["customID"]; // Assuming you have a field named customID in your HTML form

  // Get current date
  $billDate = date('Y-m-d H:i:s');

  // Iterate over the arrays to update each item in the database
  foreach ($itemCodes as $index => $itemCode) {
    $itemName = $itemNames[$index];
    $itemQuantity = $itemQuantities[$index];
    $itemPrice = $itemPrices[$index];
    $itemFinalAmount = $itemQuantity * $itemPrice; // Calculate final amount per item

    // Update the record based on Bill number and item code
    $updateQuery = "UPDATE bill_details 
                     SET item_name='$itemName', 
                         item_quantity='$itemQuantity', 
                         item_price='$itemPrice', 
                         item_final_amount='$itemFinalAmount',
                         payment_method='$paymentMethod',
                         customer_id='$customID'
                   WHERE Bill_number='$billNumber' AND item_code='$itemCode'";
    if(!mysqli_query($conn, $updateQuery)) {
      echo "Error updating item: " . mysqli_error($conn);
      // Handle the error appropriately (e.g., logging)
    }
  }

  // Update the history record
  $updateHistoryQuery = "UPDATE history 
                         SET Bill_date='$billDate', 
                             Amount='$finalAmount', 
                             Payment_method='$paymentMethod', 
                             customer_id='$customID' 
                         WHERE Bill_number='$billNumber'";
  if(!mysqli_query($conn, $updateHistoryQuery)) {
    echo "Error updating history: " . mysqli_error($conn);
    // Handle the error appropriately (e.g., logging)
  }

  echo "Bill details and history have been updated in the database";
  // Optionally, you may redirect the user after successful update
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Bill Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="../styles/style3.css" />
  <script>
    // Function to dynamically add more item rows
    function addRow() {
      var newRow = document.createElement("div");
      newRow.className = "form-row";
      newRow.innerHTML = `
        <label for="itemCode">Item Code:</label>
        <input type="text" name="itemCode[]" required>
        <label for="itemName">Item Name:</label>
        <input type="text" name="itemName[]" required>
        <label for="itemQuantity">Item Quantity:</label>
        <input type="text" name="itemQuantity[]" required>
        <label for="itemPrice">Item Price:</label>
        <input type="text" name="itemPrice[]" required>
        <label for="itemFinalAmount">Item Final Amount:</label>
        <input type="text" name="itemFinalAmount[]" required>
      `;
      document.getElementById("itemContainer").appendChild(newRow);
    }
  </script>
</head>
<body>
  <h1>Update Bill</h1>
  <form action="b_update.php" method="post">
    <div class="form-row">
      <label for="billNumber">Bill Number:</label>
      <input type="text" name="billNumber" required>
    </div>
    <div id="itemContainer">
      <!-- Initial item row -->
      <div class="form-row">
        <label for="itemCode">Item Code:</label>
        <input type="text" name="itemCode[]" required>
        <label for="itemName">Item Name:</label>
        <input type="text" name="itemName[]" required>
        <label for="itemQuantity">Item Quantity:</label>
        <input type="text" name="itemQuantity[]" required>
        <label for="itemPrice">Item Price:</label>
        <input type="text" name="itemPrice[]" required>
        <label for="itemFinalAmount">Item Final Amount:</label>
        <input type="text" name="itemFinalAmount[]" required>
      </div>
    </div>
    <!-- Button to add more item rows -->
    <button type="button" onclick="addRow()">Add Item</button>
    <div class="form-row">
      <label for="finalAmount">Final Bill Amount:</label>
      <input type="text" name="finalAmount" required>
    </div>
    <div class="form-row">
      <label for="paymentMethod">Payment Method:</label>
      <select name="paymentMethod" required>
        <option value="cash">Cash</option>
        <option value="cheque">Cheque</option>
        <option value="upi">UPI</option>
      </select>
    </div>
    <div class="form-row">
      <label for="customID">Customer ID:</label>
      <input type="text" name="customID">
    </div>

    <button type="submit" name="submit">Update Bill</button>
  </form>
</body>
</html>
