<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
    $pdo=new PDO($dsn,'staff','password');
    $sql=$pdo->prepare('select * from product where id=?');
    //商品情報を取得
    $sql->execute([$_REQUEST['id']]);
    foreach($sql as $row){
        $id=$row['id'];
        $name=$row['name'];
        $price=$row['price'];
        echo <<<end
            <p><img alt="image" src="image/$id.jpg"></p>
            <form action="cart-insert.php" method="post">
            <p>商品番号:$id</p>
            <p>商品名:$name</p>
            <p>価格:$price</p>
            <p>個数:
            <select name="count">
        end;

            for($i=1;$i<=10;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }

        echo <<< ends
            </select></p>
            <input type="hidden" name="id" value="$id">
            <input type="hidden" name="name" value="$name">
            <input type="hidden" name="price" value="$price">
            <p><input type="submit" value="カートに追加"></p>
            </form>
            <p><a href="favorite-insert.php?id=$id">お気に入りに追加</a></p>
        ends;
    }
?>
<?php require '../footer.php';?>