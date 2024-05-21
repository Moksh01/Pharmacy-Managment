<?php
    require_once("../db_connection.php");
    $query="select * from stock";
    $result=mysqli_query($conn,$query)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Customers Data </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style2.css" />

</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class ="display-6 text-center">Fetching Data </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>Stock Id</td>
                                <td>Name</td>
                                <td>In stock</td>
                                <td>Bought</td>
                                <td>Cost price</td>
                                <td>Selling Price</td>
                                <td>Last Sale</td>
                                <td>Company ID</td>
                                <td>Company Name</td>
                                <td>Expiry Date</td>
                            </tr>
                            <tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <td> <?php echo $row['Code'] ?></td>
                                    <td> <?php echo $row['Product_name'] ?></td>
                                    <td> <?php echo $row['Stock'] ?></td>
                                    <td> <?php echo $row['Bought'] ?></td>
                                    <td> <?php echo $row['Cost_price'] ?></td>
                                    <td> <?php echo $row['Selling_price'] ?></td>
                                    <td> <?php echo $row['Last_sale'] ?></td>
                                    <td> <?php echo $row['company_code'] ?></td>
                                    <td> <?php echo $row['company_name'] ?></td>
                                    <td> <?php echo $row['Expiry_date'] ?></td>
                            </tr>
                                <?php
                                }
                                ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>