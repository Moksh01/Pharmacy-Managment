<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

</head>
<body>
    <div class="container">
        <?php require "../sidebar.php";?>
        <section class="main">
      <div class="main-top">
        <h1>Mayur Medical-Stocks</h1>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-folder-plus"></i>
          <h3>Create </h3>
          <p>To add new item in stock</p>
          <a href ="../forms/s_create.php">
            <button>Click Here</button>
          </a>
        </div>
        <div class="card">
          <i class="fas fa-book"></i>
          <h3>Read</h3>
          <p>To see current stock</p>
          <a href ="../forms/s_read.php">
            <button>Click Here</button>
          </a>
        </div>
        <div class="card">
          <i class="fas fa-pen"></i>
          <h3>Update</h3>
          <p>To update current stock </p>
          <a href ="../forms/s_update.php">
            <button>Click Here</button>
          </a>
        </div>
        <div class="card">
          <i class="fas fa-trash"></i>
          <h3>Delete</h3>
          <p>To delete item from atock </p>
          <a href ="../forms/s_delete.php">
            <button>Click Here</button>
          </a>
        </div>
      </div>

    </div>
</body>
</html>