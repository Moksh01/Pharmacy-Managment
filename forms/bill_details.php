<?php
include_once("../db_connection.php");

if(isset($_POST["submit"])) {
    // Prevent SQL injection using prepared statements
    $id = $_POST["billID"];
    $query = "SELECT * FROM bill_details WHERE Bill_number=?";
    $totalAmount = 0;

    if($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get result
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if there are any rows
        if(mysqli_num_rows($result) > 0) {
            // Fetch and display bill details
            echo "<h2>Bill Details</h2>";
            echo "<table>";
            echo "<tr><th>Item Code</th><th>Item Name</th><th>Item Quantity</th><th>Item Price</th><th>Item Final Amount</th><th>Payment Method</th><th>Custom ID</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['item_code']."</td>";
                echo "<td>".$row['item_name']."</td>";
                echo "<td>".$row['item_quantity']."</td>";
                echo "<td>".$row['item_price']."</td>";
                echo "<td>".$row['item_final_amount']."</td>";
                echo "<td>".$row['payment_method']."</td>"; // Include payment method column
                echo "<td>".$row['customer_id']."</td>"; // Include custom_id column
                echo "</tr>";
                
                // Add item_final_amount to totalAmount
                $totalAmount += $row['item_final_amount'];
            }
            echo "</table>";

            // Display the total amount
            echo "<p>Bill Final Amount: $totalAmount</p>";
        } else {
            echo "No records found.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
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
    <title>Bill details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="../styles/style2.css" />
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
    
</body>
</html>