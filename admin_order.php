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
    </div>

    <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "11111111", "stores");

        if (isset($_POST['submit'])) {
            $order_id = $_POST['order_id'];
            $process = $_POST['process'];

            $q = "UPDATE order_queue SET process = '$process' WHERE order_id = '$order_id'";
            $result = mysqli_query($conn, $q);

            if ($result) {
                echo "<script>alert('주문 상태가 변경되었습니다.')</script>";
            } else {
                echo "<script>alert('주문 상태 변경에 실패하였습니다.')</script>";
            }
        }

        $q = "SELECT * FROM order_queue";
        $result = mysqli_query($conn, $q);

        
        while ($row = mysqli_fetch_assoc($result)) {
            $ID = $row['ID'];
            $order_id =  $row['order_id'];
            $total_price = $row['total_price'];
            $process = $row['process'];
            $order_address = $row['order_address'];
            $p = "SELECT * FROM order_sheet WHERE order_id = '$order_id'";
            $presult = mysqli_query($conn, $p);

            $r = "SELECT * FROM user WHERE ID = '$ID'";
            $rresult = mysqli_query($conn, $r);
            $rrow = mysqli_fetch_assoc($rresult);
            $name = $rrow['name'];

            echo "<table>";
            echo "<tr>";
            echo "<th>주문 번호</th>";
            echo "<th>구매자</th>";
            echo "<th>상품명</th>";
            echo "<th>개수</th>";
            echo "<th>총 금액</th>";
            echo "<th>주문 주소</th>";
            echo "<th>주문 진행 상황</th>";
            echo "</tr>";

            while($prow = mysqli_fetch_assoc($presult)) {
                $product_id = $prow['product_id'];
                $count = $prow['count'];
                
                echo "<tr>";
                echo "<td>".$order_id."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$product_id."</td>";
                echo "<td>".$count."개</td>";
                echo "<td>".$total_price."원</td>";
                echo "<td>".$order_address."</td>";
                echo "<td>";

                echo "<div class = 'order-status'>";
                echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                echo "<input type='hidden' name='order_id' value='".$order_id."'>";
                echo "<select name='process' class = 'order-status-select'>";
                echo "<option value='입금확인중' ".($process == '입금확인중' ? 'selected' : '').">입금확인중</option>";
                echo "<option value='입금확인완료' ".($process == '입금확인완료' ? 'selected' : '').">입금확인완료</option>";
                echo "<option value='배송중' ".($process == '배송중' ? 'selected' : '').">배송중</option>";
                echo "<option value='배송완료' ".($process == '배송완료' ? 'selected' : '').">배송완료</option>";
                echo "</select>";
                echo "<input type='submit' name='submit' value='변경' class = 'order-status-submit'>";
                echo "</form>";
                echo "</div>";

                echo "</td>";
                echo "</tr>";
                
            }
            echo "</table><br><br><br>";
        }
    ?>
    <p style='font-size: 11px; text-align: center;'> 배승옥 코튼 갤러리</p>
    <p style='font-size: 11px; text-align: center;'> 주소 : 전북 전주시 완산구 유연로 348-4 <span style='margin-left: 40px'></span> 전화번호 : 063-283-1191</p> 