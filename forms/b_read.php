<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill Information Form</title>
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
<h1>Bill Information</h1>

  <form action="bill_details.php" method="post" class="customer-form">
    <div class="form-row">
      <label for="billID">Bill ID:</label>
      <input type="text" id="billID" name="billID" required>
    </div>

    <button type="submit" name="submit">Submit</button>
  </form>

</body>
</html>
