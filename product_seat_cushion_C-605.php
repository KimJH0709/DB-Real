<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STORE</title>
  </head>
  <link rel = "stylesheet" href = "style.css">
    <div style="background-color: #f2f2f2; padding: 20px;">
        <div align="center">
            <h1 style="font-family: 'Arial Black', sans-serif; font-size: 72px; color: #555555;">
                <a href="main.php" style="text-decoration: none; color: #555555;">COTTON GALLERY</a>
            </h1>
            <p style="font-family: Arial, sans-serif; font-size: 24px; color: #888888;">The Best Cotton Products</p>
        </div>
    </div>
    <div align = 'right'>
      <?php
        session_start();
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");

            $sql = "SELECT name FROM user where ID = $user_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo "<span style='font-size: 24px; color: #333; margin-right: 10px;'>{$row['name']}님 환영합니다</span></br>";

            echo "<a href='logout.php' class='btn-login'>로그아웃</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='cart.php' class='btn'>장바구니</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='purchase_check.php' class='btn'>주문확인</a>";        
        }
        else {
            echo "<a href='login.php' class='btn-login'>로그인</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='join.php' class='btn-join'>회원가입</a>";
        }
      ?>
    </div>
    <ol>
      <li><a href="product_pillow_cover_home.php">PILLOW COVER</a></li>
      <li><a href="product_seat_cushion_home.php">SEAT CUSHION</a>
        <ol>
            <li><a href="product_seat_cushion_C-501.php">BY FABRIC</a></li>
                <ol>
                    <li><a href="product_seat_cushion_B-1000.php">B-1000</a></li>
                    <li><a href="product_seat_cushion_C-501.php">C-501</a></li>
                    <li><a href="product_seat_cushion_C-605.php">C-605</a></li>
                </ol>
            <li><a href="product_seat_cushion_small.php">BY SIZE</a></li>
        </ol>
        </li>
      <li><a href="product_etc.php">ETC</a></li>
    </ol>

    <h2>SEAT CUSHION COVER (C-605)</h2>

    <?php
      $conn = mysqli_connect("localhost", "root", "11111111", "stores");

      $sql = "SELECT * FROM products where form = 'seat cushion cover' and fabric_id = 'C-605'";
      $result = mysqli_query($conn, $sql);

      echo "<table>";
      echo "<tr>";
      echo "<th>이미지</th>";
      echo "<th>상품명</th>";
      echo "<th>가격</th>";
      echo "<th>상세정보</th>";
      echo "<th>장바구니</th>";
      echo "</tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $product_image = $row['product_image'];



        echo "<tr>";
        echo "<td><img class='product-image' src='data:image/jpeg;base64," . base64_encode($product_image) . "' alt='상품 이미지'></td>";
        echo "<td class='product-name'>$product_name</td>";
        echo "<td class='product-price'>$price 원</td>";
        echo "<td><form method='post' action='detail.php'><input type='hidden' name='product_id' value='$product_id'><button class='btn' type='submit'>상세정보</button></form></td>";
        echo "<td><form method='post' action='cart_insert_process.php'><input type='hidden' name='product_id' value='$product_id'><button class='btn' type='submit'>장바구니</button></form></td>";
        echo "</tr>";
      }
      echo "</table>";
    ?>

  </body>
  <p style='font-size: 11px; text-align: center;'> 배승옥 코튼 갤러리</p>
  <p style='font-size: 11px; text-align: center;'> 주소 : 전북 전주시 완산구 유연로 348-4 <span style='margin-left: 40px'></span> 전화번호 : 063-283-1191</p>
</html>

