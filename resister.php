<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);   


    if(isset($_POST['resister']) ){ //↓↓値の取得↓↓
        $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
        $gender = $_POST['gender'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $year = $_POST['year'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $error =0; //↑↑値の取得↑↑
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

        if($error==0){ //↓↓ユーザーを追加↓↓
          $sth = $pdo->prepare("INSERT INTO users (name,gender,month,day,year,height,weight) VALUES (:name,:gender,:month,:day,:year,:height,:weight)");
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->bindValue(':gender', $gender, PDO::PARAM_STR);
          $sth->bindValue(':month', $month, PDO::PARAM_INT);
          $sth->bindValue(':day', $day, PDO::PARAM_INT);
          $sth->bindValue(':year', $year, PDO::PARAM_INT);
          $sth->bindValue(':height', $height, PDO::PARAM_INT);
          $sth->bindValue(':weight', $weight, PDO::PARAM_INT);
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



