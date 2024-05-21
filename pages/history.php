<?php
    require_once("../db_connection.php");
    $query="select * from history";
    $result=mysqli_query($conn,$query)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Sales History Data </title>
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
                                <td>Bill Number</td>
                                <td>Bill date</td>
                                <td>Amount </td>
                                <td>Payment method</td>
                                <td>Customer id</td>
                            </tr>
                            <tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <td> <?php echo $row['Bill_number'] ?></td>
                                    <td> <?php echo $row['Bill_date'] ?></td>
                                    <td> <?php echo $row['Amount'] ?></td>
                                    <td> <?php echo $row['Payment_method'] ?></td>
                                    <td> <?php echo $row['customer_id'] ?></td>

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