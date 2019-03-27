<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);   


    if(isset($_POST['resister']) ){
      if(!$_POST['name']==null){
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $DOB = $_POST['DOB'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
          $sth = $pdo->prepare("INSERT INTO users (name,gender,DOB,height,weight) VALUES (:name,:gender,:DOB,:height,:weight)");
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->bindValue(':gender', $gender, PDO::PARAM_STR);
          $sth->bindValue(':DOB', $DOB, PDO::PARAM_STR);
          $sth->bindValue(':height', $height, PDO::PARAM_STR);
          $sth->bindValue(':weight', $weight, PDO::PARAM_STR);
          $sth->execute();
          header("location: userview.php");
         }//ユーザーを追加

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
    gender:<input type="radio" name="gender" value="male">male
           <input type="radio" name="gender" value="female">female<br>
    DOB(MM/DD/YYYY):<input type="text" name="DOB" value=""><br>
    height(cm):<input type="text" name="height" value=""><br>
    weight(kg):<input type="text" name="weight" value=""><br>
    <input type="submit" name="resister" value="resister" >
  </form>
</body>



