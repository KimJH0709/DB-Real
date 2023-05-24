<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STORE</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>제품 추가</h1>
    <form method="post" action="admin_insert_process.php" enctype="multipart/form-data" class="product-form">
      <div class="form-group">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id">
      </div>
      <div class="form-group">
        <label for="fabric_id">Fabric:</label>
        <select id="fabric_id" name="fabric_id">
          <?php
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");
            $sql = "SELECT * FROM fabric";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['fabric_id'] . '">' . $row['fabric_id'] . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name">
      </div>
      <div class="form-group">
        <label for="form">Form:</label>
        <select id="form" name="form">
          <?php
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");
            $sql = "SELECT DISTINCT form FROM form";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['form'] . '">' . $row['form'] . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="size">Size:</label>
        <select id="size" name="size">
          <?php
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");
            $sql = "SELECT DISTINCT size FROM form";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['size'] . '">' . $row['size'] . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" id="price" name="price">
      </div>
      <div class="form-group">
        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image">
      </div>
      <input type="submit" value="추가" class="submit-btn">
    </form>
  </body>
</html>
<style>
  .product-form {
    max-width: 400px;
    margin: 0 auto;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="file"],
  select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .submit-btn {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }
</style>