<?php 

require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/ngword.php');
 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');

$user_number = $_GET['dm_num'];
 ?>

<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>1on1 talk detail</h2>
  </div>
</section>
<section class="main maxWid mbPad dmShowSec postPage">
<div class="heading">
<h2>返信フォーム</h2>
   
</div>
<form action="/user/<?php echo $userInfo['dir'] ?>/?dm_checked" method="POST">
   <input type="hidden" name="recipient_id" value="<?php echo $user_number; ?>">
   <input type="hidden" name="post_type" value="posted">

<textarea maxlength="120" name="message"></textarea><br>
<?php 
if ($userInfo['dm_require'] == 'hidden') :
 ?>
   <input type="checkbox" name="post_check" id="post_check" value="true" checked style="display: none;">
<?php 
else:

 ?>
   <div class="flex">
   <input type="checkbox" name="post_check" id="post_check" value="true">
   <label for="post_check" class="notice">管理者に投稿内容を確認してもらう</label>
   </div>


 <?php endif; ?>
<div class="btnWrap">
<input type="submit" value="投稿する" />
   
</div>
</form>
 
<div class="heading">
<h2>メッセージリスト</h2>
   
</div>
  <?php


//自分のDM以外を取得・
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$where1 ='sender_id = "'.$user_number. '" and recipient_id = "'.$userInfo["id"].'"';
$where2 ='recipient_id = "'.$user_number. '" and sender_id = "'.$userInfo["id"].'"';
$where = 'WHERE '.$where1.' or ('.$where2.')';
// $stmt = $pdo->prepare('select * FROM direct_message WHERE sender_id = "'.$user_number.'" or sender_id ='.$userInfo["id"]);
$stmt = $pdo->prepare('select * FROM direct_message '.$where);
// $stmt = $pdo->prepare('select * FROM direct_message WHERE sender_id not like '.$userInfo["id"]);
$stmt->execute();
// 5.結果を取得する。【任意】
$direct_message = [];
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){ $direct_message[] = $row;}

$direct_message = sortByKey('created_timestamp', SORT_DESC, $direct_message);



$where_users = 'WHERE user_id ='.$user_number;
$stmt_users = $pdo->prepare('select * FROM users '.$where_users);
$stmt_users->execute();
$db_users = $stmt_users->fetch(PDO::FETCH_ASSOC);

global $fakeName;
nameChangeAll($db_users['name'],$db_users['screen_name']);

 ?>
<ul class='dmWrap'>
  <?php foreach ($direct_message as $key => $value) :
if($value['users_add'] =='true'){
  $user_class= '';
}else{
  $user_class= 'my_user';

}
    ?>


  <li class="<?php echo $user_class ?>">
       <span>
<?php if($value['users_add'] =='true'): ?>
        <?php echo $fakeName; ?>様
          <?php else: ?>
        <?php echo $userInfo['name']; ?>

          <?php endif; ?>
        </span>
        <?php 
date_default_timezone_set('Asia/Tokyo');
$created_timestamp = $value['created_timestamp']/1000;
$created_timestamp = date("m月d日 H時i分",$created_timestamp);
     echo "<div class='time'>";
echo $created_timestamp;
     echo "</div>";
         ?>
         <br>
      <p>
        <?php 





ngWordForDm($value['content']);
  global $includeNgWordForDm;

if(0 === $includeNgWordForDm):
  ChangeWordDm($value['content'],$userInfo['name'],$userInfo['truename']);
else:
  echo "<span class='ngWords'>【テキストは非表示です。管理者が返信後にご返信ください】</span>";
endif;
         ?>
      </p>
  </li>
<?php
  endforeach; ?>


</ul>

