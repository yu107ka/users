<?php 
    $pdo = new PDO("mysql:dbname=mydb;host=localhost;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);   


    if(isset($_POST['add']) ){
        $name = $_POST['name'];
        if(!$name==null){
          $sth = $pdo->prepare("INSERT INTO users (name) VALUES (:name)");
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->execute();
         }//ユーザーを追加
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sth = $pdo->prepare("delete from users where id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();//ユーザーを消去
    }elseif(isset($_POST['Rename'])){
        $rename = $_POST['rename'];
        if(!$rename==null){
          $id = $_POST['id'];
          $sth = $pdo->prepare("UPDATE users set name =:rename where id = :id");          $sth->bindValue(':rename', $rename, PDO::PARAM_STR);
          $sth->bindValue(':id', $id, PDO::PARAM_STR);
          $sth->execute();}//ユーザーを更新
     }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <title>users</title>
    
</head>

<body>
    <h1>add an user</h1>
    <form method="post" action="">
        <input type="text" name="name" value="">
        <input type="submit" name="add" value="Add" >
    </form>
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
                    <form method="post" action="">
                         <input type="text" name="rename" value="">
                        <button  type="submit" name="Rename">rename</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                       
                    </form>
                </td>
            </tr>
<?php
    }
?>
</body>
</html>
