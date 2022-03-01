<?php
//管理者に確認するかどうか
if (!empty($_POST['post_check'])) {
    $post_check = $_POST['post_check'];
}else{
    $post_check = '';
}


if(!empty($_POST['message'])){
 //ツイート内容
$test_message = $_POST['message'];
$recipient_id = $_POST['recipient_id'];

//承認の条件分岐
 if(empty($post_check)){
    //DM送信する
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_add.php');
    $param = '/?page_id=dmlist';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$param."'";
echo "</script>";
}else{
     require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_database_add.php');
     $param = '/?page_id=approval';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$param."'";
echo "</script>";
}



//TOPにリダイレクト
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir']."'";
echo "</script>";
}



?>