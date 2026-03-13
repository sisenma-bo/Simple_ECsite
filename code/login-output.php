<?php session_start();?>
<?php require '../menu.php';?>
<?php require '../header.php';?>
<?php
    //現在登録されているcustomerをキーとするセッションを削除
    unset($_SESSION['customer']);
    $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
    $pdo=new PDO($dsn,'staff','password');
    $sql=$pdo->prepare('select * from customer where login=? and password=?');
    $sql->execute([$_REQUEST['login'],$_REQUEST['password']]);
    
    //セッションIDを作成
    foreach($sql as $row){
        //ここは$rowの持つ全ての変数を代入しているのと同じ
        //やっていることはこれと変わらない
        // $_SESSION['customer']=$row;

        $_SESSION['customer']=[
            'id'=>$row['id'],
            'name'=>$row['name'],
            'address'=>$row['address'],
            'login'=>$row['login'],
            'password'=>$row['password']
        ];
        
    
    }
    if(isset($_SESSION['customer'])){
        echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん';
        
    }
    else{
        echo 'ログイン名またはパスワードが違います。';
    }
?>
<?php require '../footer.php';?>