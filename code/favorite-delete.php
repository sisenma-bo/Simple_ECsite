<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    if(isset($_SESSION['customer'])){
        $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
        $pdo=new PDO($dsn,'staff','password');
        $sql=$pdo->prepare('delete from favorite where customer_id=? and product_id=?');
        $sql->execute([$_SESSION['customer']['id'],$_REQUEST['id']]);
        echo 'お気に入りから商品を削除しました。';
        echo '<hr>';
    }
    else{
        echo 'お気に入りから商品を削除するには、<a href="login-input.php">ログイン</a>してください';
    }
    require 'favorite.php';
?>
<?php require '../footer.php';?>