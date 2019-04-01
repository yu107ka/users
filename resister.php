<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);   


    if(isset($_POST['resister']) ){ 
        include('input.php'); //値の取得
        $error =0;
        include('judge.php'); //入力された値が正しいかどうか
        if($error==0){ //↓↓ユーザーを追加↓↓
          $sth = $pdo->prepare("INSERT INTO users (name,gender,month,day,year,height,weight) VALUES (:name,:gender,:month,:day,:year,:height,:weight)");
          include('bindValue.php'); //変更する値をセット
          $sth->execute();
          header("location: userview.php");
          }//↑↑ユーザーを追加↑↑

}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>resister</title>
</hesd>
<body>
  <button onclick="location.href='http://localhost/userview.php'">back</button>
  <form method="post" action="">
    name:<input type="text" name="name" value=""><br>
    gender:<input type="radio" name="gender" value="male" checked="checked">male
           <input type="radio" name="gender" value="female">female<br>
    DOB(MM/DD/YYYY):<input type="number" max='12' min='1' name="month" value="">/<input type="number"  max='31' min='1' name="day" value="">/<input type="number" max='2019' min='1900' name="year" value=""><br>
    height(cm):<input type="number" name="height"max='250' min='1' value=""><br>
    weight(kg):<input type="number" name="weight"max='250' min='1' value=""><br>
    <input type="submit" name="resister" value="resister" >
  </form>
</body>


