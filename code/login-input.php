<?php require '../header.php';?>
<?php require '../menu.php';?>
<form action="login-output.php" method="post">
    <div>
        ログイン名<input type="text" name="login"><br>
        パスワード<input type="password" name="password"><br>
        <input type="submit" value="ログイン">
    </div>
    <hr>
    <p>新規会員登録は
        <a href="customer-input.php">こちら</a>
        から
    </p>
</form>    
<?php require '../footer.php';?>