<?php
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
?>