<?php session_start();?>
<?php require '../header.php';?>
<?php require '../menu.php';?>
<?php
    //初期化
    $name=$address=$login=$password='';
    //すでにセッションに登録されている場合はそれぞれの値を代入する
    if(isset($_SESSION['customer'])){
        //辞書
        $name=$_SESSION['customer']['name'];
        $address=$_SESSION['customer']['address'];
        $login=$_SESSION['customer']['login'];
        $password=$_SESSION['customer']['password'];
    }
    
    echo<<<end
        <form action="customer-output.php" method="post">
        <table>
        <tr><td>お名前</td>
        <td>
        <input type="text" name="name" value="$name">
        </td></tr>
        <tr><td>ご住所</td><td>
        <input type="text" name="address" value="$address">
        </td></tr>
        <tr><td>ログイン名</td><td>
        <input type="text" name="login" value="$login">
        </td></tr>
        <tr><td>パスワード</td><td>
        <input type="text" name="password" value="$password">
        </td></tr>
        </table>
        <input type="submit" value="確定">
        </form>
    end
?>
<?php require '../footer.php';?>

        