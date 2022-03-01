<?php
//リプライかどうか判断
if (!empty($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $post_name = "@".$_POST['post_name']." ";
}else{
    $post_id = '';
    $post_name = '';

}
//管理者に確認するかどうか
if (!empty($_POST['post_check'])) {
    $post_check = $_POST['post_check'];
}else{
    $post_check = '';
}


if(!empty($_POST['message'])){
 //ツイート内容
 $sTweet = $_POST['message'];

//承認の条件分岐
 if(empty($post_check)){
    //ツイート/リプライする
    require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/post_add.php');
    //TOPにリダイレクト
$approval_html = '/?page_id=approval';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$approval_html."'";
echo "</script>";
}else{
     require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database_add.php');
     //TOPにリダイレクト
$approval_html = '/?page_id=approval';
 echo "<script>";
 echo "location.href='/user/".$userInfo['dir'].$approval_html."'";
echo "</script>";
}


}



?>