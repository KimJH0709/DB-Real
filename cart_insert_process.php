<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        $conn = mysqli_connect("localhost", "root", "11111111", "stores");

        $ID = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        $q = "SELECT count FROM carts WHERE ID = '$ID' AND product_id = '$product_id'";
        $result = mysqli_query($conn, $q);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'] + 1;
            $q = "UPDATE carts SET count = '$count' WHERE ID = '$ID' AND product_id = '$product_id'";
        } else {
            $q = "INSERT INTO carts (ID, product_id, count) VALUES ('$ID', '$product_id', '1')";
        }

        $result = mysqli_query($conn, $q);

        if($result) {
            echo "<script>alert('장바구니에 추가되었습니다.')</script>";
            echo "<script>location.replace('main.php');</script>";
            exit;
        } else {
            echo "<script>alert('장바구니 추가에 실패했습니다.')</script>";
            echo "<script>location.replace('main.php');</script>";
            exit;
        }
    } else {
        echo "<script>alert('로그인 후 이용해주세요.')</script>";
        echo "<script>location.replace('login.php');</script>";
        exit;
    }
?>
