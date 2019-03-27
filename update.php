<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
if(isset($_POST['update']) ){
     $name = $_POST['name'];
     $gender = $_POST['gender'];
     $DOB = $_POST['DOB'];
     $height = $_POST['height'];
     $weight = $_POST['weight'];
     $id = $_POST['id'];
     $sth = $pdo->prepare("UPDATE users set name =:name,gender =:gender,DOB=:DOB,height=:height,weight=:weight where id = :id");                 
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->bindValue(':gender', $gender, PDO::PARAM_STR);
          $sth->bindValue(':DOB', $DOB, PDO::PARAM_STR);
          $sth->bindValue(':height', $height, PDO::PARAM_STR);
          $sth->bindValue(':weight', $weight, PDO::PARAM_STR);
          $sth->bindValue(':id', $id, PDO::PARAM_STR);
          $sth->execute();
          header("location: userview.php");
    }//データの更新

$id = $_GET['id'];//IDの引継ぎ

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<title>update</title>
</head>

<body>
<button onclick="location.href='http://localhost/userview.php'">back</button>
<?php
    $sth = $pdo->prepare("SELECT * FROM users where id = $id");
    $sth->execute();
    
    foreach($sth as $row) {
?>
   <tr>
   <form method="POST" action="">
    name:<input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>"><br>
<?php
 $gender=$row['gender'];
 echo $gender;
 if($gender=="male"){
?>
   gender:<input type="radio" name="gender" value="male" checked="checked">male
          <input type="radio" name="gender" value="female">female<br>
<?php
}else{
?>
   gender:<input type="radio" name="gender" value="male" >male
          <input type="radio" name="gender" value="female"checked="checked">female<br>
<?php
}
?>
    DOB(MM/DD/YYYY):<input type="text" name="DOB" value="<?= htmlspecialchars($row['DOB']) ?> "><br>
    height(cm):<input type="text" name="height" value="<?= htmlspecialchars($row['height']) ?>"><br>
    weight(kg):<input type="text" name="weight" value="<?= htmlspecialchars($row['weight']) ?>"><br>
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" >     <input type="submit" name="update" value="update" >
  </form>
</tr>
<?php
}
?>
</body>

