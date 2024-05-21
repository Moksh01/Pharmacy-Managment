<?php
    require_once("../db_connection.php");
    $query="CALL Get_Expiring_Stocks()";
    $result=mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Expiry Data </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style2.css" />

</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class ="display-6 text-center">Fetching Expiry Data </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>Product Name</td>
                                <td>Stock</td>
                                <td>Expiry Date </td>
                            </tr>
                            <tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <td> <?php echo $row['Product_name'] ?></td>
                                    <td> <?php echo $row['stock'] ?></td>
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