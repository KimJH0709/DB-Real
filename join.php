<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>STORE</title>
    </head>
    <link rel = "stylesheet" href = "style.css">
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
            <form class="form" method="post" action="join_process.php">
                <h2>회원가입</h2>
                <input type="text" name="user_id" placeholder="user_id"><br>
                <input type="password" name="user_pw" placeholder="user_pw"><br>
                <input type="password" name="check_user_pw" placeholder="check user_pw"><br>
                <input type="text" name="name" placeholder="name"><br>
                <input type="text" name="address" placeholder="address"><br>
                <input type="text" name="phone_number" placeholder="phone_number"><br>

                <input type="submit" value="회원가입">
            </form>
        </div>
    </body> 
</html>

<style>
    body {
        margin: 0 80px;
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }
</style>