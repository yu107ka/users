<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);

if(isset($_POST['update']) ){ //↓↓値の取得↓↓
     $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
     $gender = $_POST['gender'];
     $month = $_POST['month'];
     $day = $_POST['day'];
     $year = $_POST['year'];
     $height = $_POST['height'];
     $weight = $_POST['weight'];
     $id = $_POST['id']; //↑↑値の取得↑↑
    
     if($name==null){
           echo 'name is emputy.<br>';
           $error=1; //名前が空でないか
        }
     if($month==null||$day==null||$year==null){
           echo 'DOB is emputy.<br>';
           $error=1; //生年月日が空でないか
        }elseif(!checkdate( $month, $day, $year ) ){
            echo 'DOB is not appropriate.<br>';
            $error=1; //生年月日が適切か
        }
     if($height==null){
           echo 'height is emputy.<br>';
           $error=1; //身長が空でないか
        }
     if($weight==null){
           echo 'weight is emputy.<br>';
           $error=1; //体重が空でないか
        } 
     if($error==0){ //↓↓ユーザーを更新↓↓
          $sth = $pdo->prepare("UPDATE users set name =:name,gender =:gender,month=:month,day=:day,year=:year,height=:height,weight=:weight where id = :id"); 
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->bindValue(':gender', $gender, PDO::PARAM_STR);
          $sth->bindValue(':month', $month, PDO::PARAM_INT);
          $sth->bindValue(':day', $day, PDO::PARAM_INT);
          $sth->bindValue(':year', $year, PDO::PARAM_INT);
          $sth->bindValue(':height', $height, PDO::PARAM_INT);
          $sth->bindValue(':weight', $weight, PDO::PARAM_INT);
          $sth->bindValue(':id', $id, PDO::PARAM_INT);
          $sth->execute();
          header("location: userview.php");
    }//↑↑ユーザーを更新↑↑
}
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
    DOB(MM/DD/YYYY):<input type="number" name="month"max='12' min='1' value="<?= htmlspecialchars($row['month']) ?>">/
                    <input type="number" name="day" max='31' min='1'value="<?= htmlspecialchars($row['day']) ?>">/
                    <input type="number" name="year"max='2019' min='1900' value="<?= htmlspecialchars($row['year']) ?>"><br>
    height(cm):<input type="number" name="height"max='250' min='1' value="<?= htmlspecialchars($row['height']) ?>"><br>
    weight(kg):<input type="number" name="weight" max='250' min='1'value="<?= htmlspecialchars($row['weight']) ?>"><br>
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" >     <input type="submit" name="update" value="update" >
  </form>
</tr>
<?php
}
?>
</body>

