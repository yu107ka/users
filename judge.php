<?php
     if($name==null){
           echo 'name is emputy.<br>';
           $error=1; //���O����łȂ���
        }
     if($month==null||$day==null||$year==null){
           echo 'DOB is emputy.<br>';
           $error=1; //���N��������łȂ���
        }elseif(!checkdate( $month, $day, $year ) ){
            echo 'DOB is not appropriate.<br>';
            $error=1; //���N�������K�؂�
        }
     if($height==null){
           echo 'height is emputy.<br>';
           $error=1; //�g������łȂ���
        }
     if($weight==null){
           echo 'weight is emputy.<br>';
           $error=1; //�̏d����łȂ���
        }         
?>