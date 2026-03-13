<?php require '../header.php'?>
<?php require '../menu.php'?>
<form action="product.php" method ="post">
    商品検索
    <input type="text" name="keyword">
    <input type="submit" value="検索">
</form>
<hr>
<?php  
    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';
    $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
    $pdo=new PDO($dsn,'staff','password');
    if(isset($_REQUEST['keyword'])){
        $sql=$pdo->prepare('select * from product where name like ?');
        $sql->execute(['%'.$_REQUEST['keyword'].'%']);
    } 
    else{
        $sql=$pdo->query('select * from product');
    }
    foreach($sql as $row){
        $id=$row['id'];
        $name=$row['name'];
        $price=$row['price'];
        echo<<<end
            <tr>
            <td>$id</td>
            <td>
            <a href="detail.php?id=$id">$name</a>
            </ed>
            <td> $price</td>
            </tr>
        end;
    }
    echo '</table>';