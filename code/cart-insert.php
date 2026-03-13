<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    $id=$_REQUEST['id'];
    // セッションがセットされていなかったら中身を空にする
    if(!isset($_SESSION['product'])){
        $_SESSION['product']=[];
    }
    $count=0;
    // セットされているならセッションにあるcountを変数countの中に格納する
    if(isset($_SESSION['product'][$id])){
        $count=$_SESSION['product'][$id]['count'];
    }
    // セッションの中身をセットする
    $_SESSION['product'][$id]=[
        'name'=>$_REQUEST['name'],
        'price'=>$_REQUEST['price'],
        'count'=>$count+$_REQUEST['count']
    ];
    echo '<p>カートに商品を追加しました。</p>';
    echo '<hr>';
    require 'cart.php';
?>
<?php require '../footer.php';?>