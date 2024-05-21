<?php
include_once("../db_connection.php");

if(isset($_POST["submit"])) {
    $code = $_POST["code"];
    $productName = $_POST["product_name"];
    $stock = $_POST["stock"];
    $bought = $_POST["bought"];
    $costPrice = $_POST["cost_price"];
    $sellingPrice = $_POST["selling_price"];
    $lastSale = $_POST["last_sale"];
    $companyCode = $_POST["company_code"];
    $companyName = $_POST["company_name"];
    $expiryDate = $_POST["expiry_date"];

    $query = "INSERT INTO stock (Code, Product_name, Stock, Bought, Cost_price, Selling_price, Last_sale, company_code, company_name, Expiry_date) VALUES ('$code', '$productName', '$stock', '$bought', '$costPrice', '$sellingPrice', '$lastSale', '$companyCode', '$companyName', '$expiryDate')";
    
    if(mysqli_query($conn, $query)) {
        echo "Your data has been saved into the database";
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
  <form action="s_create.php" method="post" class="customer-form">
    <div class="form-row">
      <label for="code">Code:</label>
      <input type="text" id="code" name="code" required>
    </div>
    <div class="form-row">
      <label for="product_name">Product Name:</label>
      <input type="text" id="product_name" name="product_name" required>
    </div>
    <div class="form-row">
      <label for="stock">Stock:</label>
      <input type="number" id="stock" name="stock" required>
    </div>
    <div class="form-row">
      <label for="bought">Bought:</label>
      <input type="number" id="bought" name="bought" required>
    </div>
    <div class="form-row">
      <label for="cost_price">Cost Price:</label>
      <input type="number" id="cost_price" name="cost_price" required>
    </div>
    <div class="form-row">
      <label for="selling_price">Selling Price:</label>
      <input type="number" id="selling_price" name="selling_price" required>
    </div>
    <div class="form-row">
      <label for="last_sale">Last Sale:</label>
      <input type="date" id="last_sale" name="last_sale">
    </div>
    <div class="form-row">
      <label for="company_code">Company Code:</label>
      <input type="text" id="company_code" name="company_code" required>
    </div>
    <div class="form-row">
      <label for="company_name">Company Name:</label>
      <input type="text" id="company_name" name="company_name" required>
    </div>
    <div class="form-row">
      <label for="expiry_date">Expiry Date:</label>
      <input type="date" id="expiry_date" name="expiry_date" required>
    </div>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>
