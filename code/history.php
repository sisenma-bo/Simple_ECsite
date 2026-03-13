<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    //関数ゾーン
    // テーブルヘッダーを作成
    function create_th(){
        echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
    }
    // 商品番号などに使う
    function create_td($value){
        echo '<td>',$value,'</td>';
    }
    // アンカー付きのtdを作成（商品名に使う)
    function create_td_anker($product_id,$value){
        echo '<td><a href="detail.php?id=',$product_id,'">',$value,'</a></td>';
    }
    // totalを表示するのに使う
    function create_sum($value){
        create_td('合計');
        create_td('');
        create_td('');
        create_td('');
        create_td($value);
    }

    $total=0;
    $dsn='mysql:host=localhost;dbname=shop;charset=utf8';
    $pdo=new PDO($dsn,'staff','password');
    // 内部結合
    $log=$pdo->query('select * from purchase_detail inner join product on purchase_detail.product_id=product.id order by purchase_id desc,product_id');
    // 一番大きい購入番号を取得
    $max=$pdo->query('select max(purchase_id) from purchase_detail');
    $max=$max->fetch();
    // echo $min[0];
    //それぞれに購入番号を代入
    $now=$max[0];
    $next=$max[0];
    echo '<table>';
    create_th();
    foreach($log as $row){
        //購入番号を代入
        $next=$row['purchase_id'];
        // 購入番号が変わったら
        if($now!=$next&&$now!=0){
            $now=$next;
            create_sum($total);
            $total=0;
            echo '</table>';
            echo '<hr>';
            echo '<table>';
            create_th();
        }
        echo '<tr>';
        create_td($row['id']);
        create_td_anker($row['id'],$row['name']);
        create_td($row['price']);
        create_td($row['count']);
        $total=$total+$row['price']*$row['count'];
        create_td($row['price']*$row['count']);
        echo '</tr>';
    }
    create_sum($total);
    echo '</table>';
    echo '<hr>';
?>
<?php require '../footer.php';?>