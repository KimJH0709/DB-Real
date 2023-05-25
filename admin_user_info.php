<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STORE</title>
  </head>
  <link rel = "stylesheet" href = "style.css">
    <div align = 'center'>
      <h1 style='font-family: "Arial Black", sans-serif; font-size: 52px;'>
        관리자모드
      </h1>
    </div>
    <div align = 'right'>
      <?php
        session_start();
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            echo "<a href='logout.php' class='btn-login'>로그아웃</a></br>";
        }
      ?>
    
      <a href = 'admin.php' class = 'btn-login'> UPDATE/DELETE </a>
      <span style='margin-left: 20px'></span>
      <a href = 'admin_insert.php'class = 'btn-login'> INSERT </a>
      <span style='margin-left: 20px'></span>
      <a href = 'admin_order.php'class = 'btn-login'> 주문확인 </a>
      <span style='margin-left: 20px'></span>
      <a href = 'admin_user_info.php'class = 'btn-login'> 유저관리 </a>
    </div>
    <table>
      <tbody>
        <?php
          $conn = mysqli_connect("localhost", "root", "11111111", "stores");

          $sql = "SELECT * FROM user";
          $result = mysqli_query($conn, $sql);

          echo "<table>";
          echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>user_id</th>";
          echo "<th>user_pw</th>";
          echo "<th>name</th>";
          echo "<th>address</th>";
          echo "<th>phone_number</th>";
          echo "<th>삭제</th>";
          echo "</tr>";
          while ($row = mysqli_fetch_assoc($result)) {

            if ($row['ID'] != 1){
              $ID = $row['ID'];
              $user_id = $row['user_id'];
              $user_pw = $row['user_pw'];
              $name = $row['name'];
              $address = $row['address'];
              $phone_number = $row['phone_number'];
              echo "<tr>";
              echo "<td class='product-name'>$ID</td>";
              echo "<td class='product-name'>$user_id</td>";
              echo "<td class='product-name'>$user_pw</td>";
              echo "<td class='product-name'>$name</td>";
              echo "<td class='product-name'>$address</td>";
              echo "<td class='product-name'>$phone_number</td>";
              echo "<td>";
              echo "<form method='post' action='admin_user_delete_process.php'>";
              echo "<input type='hidden' name='ID' value='$ID'>";
              echo "<button class='btn' button type='submit'>DELETE</button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";
            }
          }
          echo "</table>";
        ?>
      </tbody>
    </table>


  </body>
  <p style='font-size: 11px; text-align: center;'> 배승옥 코튼 갤러리</p>
  <p style='font-size: 11px; text-align: center;'> 주소 : 전북 전주시 완산구 유연로 348-4 <span style='margin-left: 40px'></span> 전화번호 : 063-283-1191</p>
</html>