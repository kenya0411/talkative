
<?php 

if (!empty($_GET['page_id'])) {
$page_id = $_GET['page_id'];
}else{
$page_id = '';

}
if (!empty($_POST['post_type'])) {
$post_type = $_POST['post_type'];
}else{
$post_type = '';

}
$url = $_SERVER["HTTP_HOST"];
$master_user = 'mas';
if (strstr($url , "mack.local")==true) {
$auth_user = 'mas';
}elseif (strstr($url , "localhost")==true||strstr($url , "192.168.0.5")==true) {
$auth_user = 'mas';
}else{
$auth_user = $_SERVER['PHP_AUTH_USER'];
}


 ?>