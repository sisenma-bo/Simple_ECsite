<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    
    $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
    $pdo=new PDO($dsn,'staff','password');
    
    if($_SESSION['product']==[]){
        echo 'カートに商品が入っていません';
    }
    else{
        echo "購入しました";
        // purchaseに登録
        // 顧客番号取得
        $id=$pdo->prepare('select id from customer where login=? AND password=?');
        $id->execute([$_SESSION['customer']['login'],$_SESSION['customer']['password']]);
        //user_idに顧客番号を代入
        $user_id=$id->fetch();
        // echo gettype($user_id[0]);

        $purchase=$pdo->prepare('insert into purchase values(?,?)');
        //現在の購入番号の最大値を取得
        $max=$pdo->query('select MAX(id) from purchase');
        $max=$max->fetch();
        // echo gettype($max[0]+1);
        //最大値に+1
        $new_max=$max[0]+1;
        // echo gettype($new_max);
        // echo gettype(max[0]);
        // purchaseに登録
        $purchase->execute([$new_max,$user_id[0]]);

        // // purchase_detailに登録
        //セッションに登録されている（カートの中身）ものを一つずつ取り出す
        
        foreach($_SESSION['product'] as $id=>$product){
            $detail=$pdo->prepare('insert into purchase_detail values(?,?,?)');
            // echo "id:",$id;
            // echo "個数",$product['count'];
            // echo '</br>';
            $detail->execute([$new_max,$id,$product['count']]);
        }
        $_SESSION['product']=[];
    }
    
?>
<?php require '../footer.php';?>