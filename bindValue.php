<?php
          $sth->bindValue(':name', $name, PDO::PARAM_STR);
          $sth->bindValue(':gender', $gender, PDO::PARAM_STR);
          $sth->bindValue(':month', $month, PDO::PARAM_INT);
          $sth->bindValue(':day', $day, PDO::PARAM_INT);
          $sth->bindValue(':year', $year, PDO::PARAM_INT);
          $sth->bindValue(':height', $height, PDO::PARAM_INT);
          $sth->bindValue(':weight', $weight, PDO::PARAM_INT);
?>