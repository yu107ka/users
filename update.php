<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);


if(isset($_POST['update']) ){
     include('input.php'); //�l�̎擾
     $id = $_POST['id']; //�ύX����ID�̎擾
     $error=0;
     include('judge.php'); //���͂��ꂽ�l�����������ǂ���
     if($error==0){ //�������[�U�[���X�V����
          $sth = $pdo->prepare("UPDATE users set name =:name,gender =:gender,month=:month,day=:day,year=:year,height=:height,weight=:weight where id = :id"); 
          include('bindValue.php'); //�ύX����l���Z�b�g
          $sth->bindValue(':id', $id, PDO::PARAM_INT);
          $sth->execute();
          header("location: userview.php");
    }//�������[�U�[���X�V����
}
$id = $_GET['id'];//ID�̈��p��

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
