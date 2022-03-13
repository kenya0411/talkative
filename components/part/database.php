

<?php
$userid = $userInfo["id"];
// 1.データベースに接続する。
$url = $_SERVER["HTTP_HOST"];
if (strstr($url , "127.0.0.1")==true) {
$pdo = new PDO('mysql:dbname=talkative;host=localhost;charset=utf8mb4' , 'root', 'root');

}elseif (strstr($url , "127.0.0.1")==true||strstr($url , "192.168.0.5")==true||strstr($url , "localhost")==true) {
$pdo = new PDO('mysql:dbname=talkative;host=localhost;charset=utf8mb4' , 'root', 'root');

}else{
$pdo = new PDO('mysql:dbname=wbqocedq_talkative;host=localhost;charset=utf8mb4' , 'wbqocedq_talk', 'N~-WZ5EHv]4y');

}
$pdo->query('SET NAMES utf8mb4;');

?>



