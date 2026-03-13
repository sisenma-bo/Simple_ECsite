<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php 
    if(isset($_SESSION['customer'])){
        $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
        $pdo=new PDO($dsn,'staff','password');
        // すでにお気に入りに登録していないかチェック
        $search=$pdo->prepare('select * from favorite where product_id=?');
        $search->execute([$_REQUEST['id']]);
        $search=$search->fetchColumn();
        // 追加のSQL(一致するものがないときのみ実行)
        if(empty($search)){
            $sql=$pdo->prepare('insert into favorite values(?,?)');
            $sql->execute([$_SESSION['customer']['id'],$_REQUEST['id']]);
            echo 'お気に入りに追加しました';
        }
        else{
            echo 'すでにお気に入り登録をしています。';
        }
        
        
        
        echo '<hr>';
        require 'favorite.php';
    }
    else{
        echo 'お気に入りに追加するには、<a href="login-input.php">ログイン</a>してください。';
    }