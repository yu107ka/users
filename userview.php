<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);   

     if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sth = $pdo->prepare("delete from users where id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();//ユーザーを消去
     }
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>userview</title>
    
</head>

<body>
 <input type="button" onClick="location.href='http://localhost/resister.php'" value="Resister Now">

<h2>users</h2>
<br>
<?php
    $sth = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
    $sth->execute();
    
    foreach($sth as $row) {
?>
                 <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Delete</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                    <form method="get" action="update.php">
		      <input type="hidden" name="id" value="<?= $row['id'] ?> "> 
 		      <button  type="submit" name="Update">Update</button>
                    </form>
                </td>
            </tr>
<?php
    }
?>

</body>

