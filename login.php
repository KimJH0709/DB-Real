<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div style="background-color: #f2f2f2; padding: 20px;">
            <div align="center">
                <h1 style="font-family: 'Arial Black', sans-serif; font-size: 72px; color: #555555;">
                    <a href="main.php" style="text-decoration: none; color: #555555;">COTTON GALLERY</a>
                </h1>
                <p style="font-family: Arial, sans-serif; font-size: 24px; color: #888888;">The Best Cotton Products</p>
            </div>
        </div>
        <div class="container">
            <div class="form">
                <h2>로그인</h2>
                <form method="post" action="login_process.php">
                    <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                    <input type="text" name="user_id" placeholder="user_id"><br>
                    <input type="password" name="user_pw" placeholder="user_pw"><br>
                    <input type="submit" value="로그인">
                </form>
            </div>
        </div>
    </body>
</html>

<style>
    body {
        margin: 0 80px;
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
    }

    .logo {
        font-family: "Arial Black", sans-serif;
        font-size: 52px;
        margin-bottom: 40px;
    }

    .form {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form h2 {
        margin-bottom: 30px;
    }

    .form input[type="text"],
    .form input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: none;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form input[type="submit"] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 12px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .form input[type="submit"]:hover {
        background-color: #3e8e41;
    }

    .error {
        color: red;
        margin-top: 20px;
    }

</style>