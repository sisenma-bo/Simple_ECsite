<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    if(isset($_SESSION['customer'])){
        echo '<p>お名前:',$_SESSION['customer']['name'];
        echo '<p>ご住所:',$_SESSION['customer']['address'];
        echo '<hr>';
        require 'cart.php';
        echo '<hr>';
        echo '<p>内容をご確認いただき、購入を確定してください。';
        echo '<p><a href="purchase-output.php">購入を確定</a></p>';
    }
    else{
        echo '購入するには';
        echo '<a href="login-input.php">ログイン</a>';
        echo 'してください。';
    }
?>