<?php 
if (!empty($_POST['check'])) {
$approval_check = $_POST['check'];
}else{
$approval_check = "";

}


if($approval_check == "true"){
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database_delete.php');
  
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/posted.php');

$param = '/?page_id=approval';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$param."'";
echo "</script>";

}else{
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database_delete.php');
     $param = '/?page_id=approval';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$param."'";
echo "</script>";


}









?>