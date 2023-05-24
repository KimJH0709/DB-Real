<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        $conn = mysqli_connect("localhost", "root", "11111111", "stores");

        $ID = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $total_price = $_POST['total_price'];

        $q = "INSERT INTO order_queue (ID, total_price, process) VALUES ('$ID', '$total_price', '입금확인중')";
        $result = mysqli_query($conn, $q);

        $q = "SELECT * FROM order_queue where ID = '$ID' and total_price = $total_price";
        $result = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($result);
        $order_id = $row['order_id'];

        $q = "SELECT * FROM carts where ID = '$ID'";
        $result = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_assoc($result)) {
            $count = $row['count'];
            $q = "INSERT INTO order_sheet (ID, product_id, count, order_id) VALUES ('$ID', '".$row['product_id']."', '$count', '$order_id')";
            mysqli_query($conn, $q);
        }

        
        $q = "DELETE FROM carts where ID = '$ID'";
        $result = mysqli_query($conn, $q);


        if ($result){
            echo "<script>alert('주문이 완료되었습니다.')</script>";
            echo "<script>location.replace('cart.php');</script>";
        }
        else{
            echo "<script>alert('주문이 실패하였습니다.')</script>";
            echo "<script>location.replace('cart.php');</script>";
        }

    } else {
        echo "<script>alert('로그인 후 이용해주세요.')</script>";
        echo "<script>location.replace('login.php');</script>";
        exit;
    }
?>
