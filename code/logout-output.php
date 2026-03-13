<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    //setされている=ログインしている
    //unsetでログイン処理
    if(isset($_SESSION['customer'])){
        unset($_SESSION['customer']);
        echo 'ログアウトしました。';
    }
    //setされていない=ログインしていないかすでにログアウト済み
    else{
        echo 'すでにログアウトしています。';
    }
?>
<?php require '../footer.php';?>