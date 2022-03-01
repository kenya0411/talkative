<?php

if (!empty($_POST['check'])) {
$approval_check = $_POST['check'];
}else{
$approval_check = "";

}
$test_message = $_POST['message'];
$recipient_id = $_POST['recipient_id'];

if($approval_check == "true"){
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database_delete.php');
    
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_add.php');
  



}else{
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database_delete.php');

}


//TOPにリダイレクト
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir']."/?page_id=approval'";
echo "</script>";



?>