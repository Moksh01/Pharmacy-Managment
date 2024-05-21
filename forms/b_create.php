<?php
include_once("../db_connection.php");

if (isset($_POST["submit"])) {
    $billNumber = $_POST["billNumber"];
    $itemCodes = $_POST["itemCode"];
    $itemNames = $_POST["itemName"];
    $itemQuantities = $_POST["itemQuantity"];
    $paymentMethod = $_POST["paymentMethod"];
    $customID = isset($_POST["customID"]) ? $_POST["customID"] : null; // If custom ID is not set, default to null

    // Get today's date
    $billDate = date("Y-m-d");

    // Insert data into history table with initial amount set to 0
    $historyQuery = "INSERT INTO history (Bill_number, Bill_date, Amount, Payment_method, customer_id) 
                     VALUES ('$billNumber', '$billDate', 0, '$paymentMethod', '$customID')";
    if (!mysqli_query($conn, $historyQuery)) {
        echo "Error inserting data into history: " . mysqli_error($conn);
        exit;
    }

    // Iterate over the arrays to insert each item into the database
    foreach ($itemCodes as $index => $itemCode) {
        $itemName = $itemNames[$index];
        $itemQuantity = $itemQuantities[$index];

        // Call the get_selling_price procedure
        $stmt = $conn->prepare("CALL get_selling_price(?, @p_sellingPrice)");
        $stmt->bind_param("s", $itemCode);
        $stmt->execute();
        $stmt->close();

        // Fetch the selling price
        $result = $conn->query("SELECT @p_sellingPrice AS sellingPrice");
        $row = $result->fetch_assoc();
        $itemPrice = $row['sellingPrice'];

        // Calculate the final amount for the item
        $itemFinalAmount = $itemQuantity * $itemPrice;

        // Check if the combination of Bill_number and item_code already exists
        $query = "SELECT * FROM bill_details WHERE Bill_number='$billNumber' AND item_code='$itemCode'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            // If the combination does not exist, insert the record
            $insertQuery = "INSERT INTO bill_details (Bill_number, item_code, item_name, item_quantity, item_price, item_final_amount, bill_amount, payment_method, customer_id) 
                            VALUES ('$billNumber', '$itemCode', '$itemName', '$itemQuantity', '$itemPrice', '$itemFinalAmount', 0, '$paymentMethod', '$customID')";
            if (!mysqli_query($conn, $insertQuery)) {
                echo "Error: " . mysqli_error($conn);
                exit;
            }
        } else {
            echo "Duplicate entry: Bill number $billNumber and item code $itemCode already exist.";
            exit;
        }
    }

    // Call the calculate_final_amount procedure to update the total bill amount
    $stmt = $conn->prepare("CALL calculate_final_amount(?)");
    $stmt->bind_param("s", $billNumber);
    $stmt->execute();
    $stmt->close();

    echo "Bill details have been saved into the database";
    header("refresh:2,url=../pages/bills.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Bill Form</title>
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
      `;
      document.getElementById("itemContainer").appendChild(newRow);
    }
  </script>
</head>
<body>
  <h1>Create Bill</h1>
  <form action="b_create.php" method="post">
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
      </div>
    </div>
    <!-- Button to add more item rows -->
    <button type="button" onclick="addRow()">Add Item</button>
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
    <button type="submit" name="submit">Create Bill</button>
  </form>
</body>
</html>

