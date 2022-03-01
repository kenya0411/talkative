<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>1on1 talk list</h2>
  </div>
</section>
<section class="main maxWid mbPad dmList">


  <?php
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/ngword.php');

 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');
  $data = array(
"count"=>'50',
"user_id"=>$userInfo['id'],
  );
  $code = $twObj->request( 'GET', "https://api.twitter.com/1.1/direct_messages/events/list.json",$data);
  $aResData = json_decode($twObj->response["response"], true);

//配列を展開
  if(isset($aResData['errors']) && $aResData['errors'] != ''){
   ?>
   <!-- 取得に失敗しました。<br/> -->

   <?php
 }else{


 // }//end for
 $get_dm_list = $aResData['events'];
echo '<pre>';
// var_dump($get_dm_list);
echo '</pre>';
 foreach ( $get_dm_list as $key => $value) {
if(!empty($value['message_create']['source_app_id'])){
$source_app_id = $value['message_create']['source_app_id'];
}else{
$source_app_id = '';

}

$dm_id = trim($value['id']);
$created_timestamp = $value['created_timestamp'];
$recipient_id = $value["message_create"]["target"]['recipient_id'];
$sender_id = $value["message_create"]['sender_id'];
$content = $value["message_create"]["message_data"]['text'];
$myuser_id =$userInfo["id"];

//同じIDがないか確認
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('SELECT * FROM direct_message WHERE dm_id = :dm_id');
$stmt->bindValue(':dm_id', $dm_id, PDO::PARAM_STR);
$stmt->execute();
// 5.結果を取得する。【任意】
$direct_message = $stmt->fetch();

//同じIDがない場合データベースに登録
if(empty($direct_message)){

  try {
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($sender_id  == $myuser_id){
$users_add = 'false';
$group_id = $recipient_id ;
    }else{
$users_add = 'true';
$group_id = $sender_id ;

    }
    $q = $pdo->exec("INSERT INTO direct_message (dm_id, created_timestamp,recipient_id,sender_id,content,myuser_id,users_add,source_app_id,group_id )
      VALUES ('$dm_id ', '$created_timestamp','$recipient_id', '$sender_id','$content','$myuser_id','$users_add','$source_app_id','$group_id')");
  } catch (PDOException $e) {
    print '書き込みできませんでした' . $e->getMessage();
  }
}


 }

 insertDatabaseUsers($pdo,$twObj,$userInfo);
// if(!empty($aResData_user['id'])):
// global $fakeName;
// nameChangeAll($aResData_user['name'],$aResData_user['screen_name']);
// 
}

  ?>

<?php
// endif;
getDmUsers($pdo,$userInfo);


// 6.データーベースから切断する。
unset($pdo);


?>
</section>




<?php 
/*--------------------------------------------------- */
/* ユーザー情報をデータベースに登録
/*--------------------------------------------------- */
function insertDatabaseUsers($pdo,$twObj,$userInfo){

//自分のDM以外を取得・
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('select * FROM direct_message WHERE users_add not like "false" and myuser_id ='.$userInfo["id"]);
// $stmt = $pdo->prepare('select * FROM direct_message WHERE sender_id not like '.$userInfo["id"]);
$stmt->execute();
// 5.結果を取得する。【任意】
$direct_message = [];
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){ $direct_message[] = $row;}

foreach ($direct_message as $key => $value) {
$user_id =$value['sender_id'];
$created_timestamp =$value['created_timestamp'];


//同じIDがないか確認
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->execute();
$db_users = $stmt->fetch();

if(empty($db_users)){
  //未登録の場合データベースにユーザー情報を登録
ifNewUser($pdo,$twObj,$value,$created_timestamp,$user_id,$userInfo);

}elseif($created_timestamp > $db_users['created_timestamp']){
//タイムスタンプが新しい場合更新
ifNewTimeUser($pdo,$twObj,$value,$created_timestamp,$user_id,$userInfo);

}


}

}

//
/*--------------------------------------------------- */
/* //データベースにユーザー情報を登録
/*--------------------------------------------------- */
function ifNewUser($pdo,$twObj,$value,$created_timestamp,$user_id,$userInfo){
$data = array(
"user_id"=>$value['sender_id'],
  );
  $code_user = $twObj->request( 'GET', "https://api.twitter.com/1.1/users/show.json",$data);
  $aResData_user = json_decode($twObj->response["response"], true);
 
//BANユーザー対策
  if(!empty($aResData_user['name'])){

$name = $aResData_user['name'];
$screen_name = $aResData_user['screen_name'];
$latest_content = $value['content'];
$myuser_id =$userInfo["id"];

  }else{
    $name = '';
$screen_name = '';
$latest_content = $value['content'];
$myuser_id =$userInfo["id"];

  }

  try {
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->exec("INSERT INTO users (user_id, name,screen_name,created_timestamp,latest_content,myuser_id)
      VALUES ('$user_id ', '$name','$screen_name','$created_timestamp','$latest_content','$myuser_id')");
  } catch (PDOException $e) {
    print '書き込みできませんでした' . $e->getMessage();
  }

}



/*--------------------------------------------------- */
/* //タイムスタンプが新しい場合DBに情報を更新
/*--------------------------------------------------- */

function ifNewTimeUser($pdo,$twObj,$value,$created_timestamp,$user_id,$userInfo){
$data = array(
"user_id"=>$value['sender_id'],
  );
  $code_user = $twObj->request( 'GET', "https://api.twitter.com/1.1/users/show.json",$data);
  $aResData_user = json_decode($twObj->response["response"], true);
  if(!empty($aResData_user['name'])){
$latest_content = $value['content'];
$name = $aResData_user['name'];
$myuser_id =$userInfo["id"];
$screen_name = $aResData_user['screen_name'];
  try {
    $q = $pdo->prepare("UPDATE users SET user_id=:user_id,name=:name,screen_name=:screen_name,created_timestamp=:created_timestamp,latest_content=:latest_content,myuser_id=:myuser_id WHERE user_id=:user_id");

  //トランザクション処理
  $pdo->beginTransaction();

    $q ->bindParam(':name', $name);
    $q ->bindParam(':user_id', $user_id);
    $q ->bindParam(':screen_name', $screen_name);
    $q ->bindParam(':created_timestamp', $created_timestamp);
    $q ->bindParam(':latest_content', $latest_content);
    $q ->bindParam(':myuser_id', $myuser_id);
    $q->execute(); 
    //コミット
    $pdo->commit();

  } catch (PDOException $e) {
    print '書き込みできませんでした' . $e->getMessage();
  }
  }
}




/*--------------------------------------------------- */
/* ユーザー情報出力
/*--------------------------------------------------- */
function getDmUsers($pdo,$userInfo){

 //DMのあるユーザーを取得
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare('select * FROM users where myuser_id = '.$userInfo['id']);
$stmt->execute();
// 5.結果を取得する。【任意】
$db_users = [];
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){ $db_users[] = $row;}
$db_users = sortByKey('created_timestamp', SORT_DESC, $db_users);







echo "<ul class='dmWrap'>";


foreach ($db_users as $key => $value) :
global $fakeName;
nameChangeAll($value['name'],$value['screen_name']);


if(!empty($value['name'])):
$stmt_last = $pdo->prepare('select * FROM direct_message where group_id = '.$value['user_id']);
$stmt_last->execute();
$last_message=$stmt_last->fetchAll(PDO::FETCH_ASSOC);
$last_message = sortByKey('created_timestamp', SORT_DESC, $last_message);

  $latest_message = $value['latest_content'];
  $latest_id = '';
if(!empty($last_message)){
  $latest_message = $last_message[0]['content'];
  $latest_id = $last_message[0]['sender_id'];

}
?>
  <li>
    <a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=dmshow&dm_num=<?php echo $value['user_id'] ?>"><span class="nameTitle"><?php echo $fakeName;; ?><i class="fas fa-caret-right"></i></span><br>
      <?php 
date_default_timezone_set('Asia/Tokyo');

$created_timestamp = $value['created_timestamp']/1000;
$created_timestamp = date("m月d日 H時i分",$created_timestamp);
     echo "<div class='time'>";
echo $created_timestamp;
     echo "</div><br>";
       ?>
      <p>
        <?php 


ngWordForDm($latest_message);
  global $includeNgWordForDm;

if(0 === $includeNgWordForDm):
  if($latest_id == $userInfo['id']){
  echo 'あなた：';
  ChangeWordDm($latest_message,$userInfo['name'],$userInfo['truename']);

}else{
  ChangeWordDm($latest_message,$userInfo['name'],$userInfo['truename']);

}
else:
  echo "<span class='ngWords'>【テキストは非表示です。管理者が返信後にご返信ください】</span>";
endif;

         ?>

        
      </p>
    </a>
  </li>

<?php
endif;
endforeach;

echo "</ul>";



}


 ?>

