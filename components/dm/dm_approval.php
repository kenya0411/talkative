<?php 

$stmt = $pdo->prepare('SELECT * FROM post_content WHERE approval = :approval AND user_id = :user_id AND status = :dm');
$stmt->bindValue(':approval', 'yet', PDO::PARAM_STR);
$stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
$stmt->bindValue(':dm','dm', PDO::PARAM_STR);
$stmt->execute();
$rows = ''; 
$dm_content=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach((array)$rows as $row){ print_r($row);}
foreach((array)$rows as $row){ print_r($row);}


foreach ($dm_content as $key => $value) :

$user_number = $value["twitter_id"];
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




$where_users = 'WHERE user_id ='.$user_number;
$stmt_users = $pdo->prepare('select * FROM users '.$where_users);
$stmt_users->execute();
$db_users = $stmt_users->fetch(PDO::FETCH_ASSOC);

global $fakeName;
nameChangeAll($db_users['name'],$db_users['screen_name']);
 
echo '<pre>';
$count = count($direct_message) - 2;
echo '</pre>';
 ?>
 <form action="/user/<?php echo $userInfo['dir'] ?>/?page_id=dm_approval_checked"  method="POST">
  <div class="approvalWrap">
<!-- <ul class='dmWrap'> -->
  <div class="talkBlock originalBlock">
  <?php foreach ($direct_message as $num => $val) :?>
<?php if ($num >= $count): ?>
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize">
<?php if($val['users_add'] =='true'): ?>
  <?php 
$link = '/user/'.$userInfo["dir"].'/?page_id=dmshow&dm_num='.$val['group_id'];
   ?>
  <a href="<?php echo $link ?>">

        <?php echo $fakeName; ?>様</a>
          <?php else: ?>
        <?php echo $userInfo['name']; ?>

          <?php endif; ?>
        </h3>
      </div>

    </div>
    <div class="textBlock">
      <p>

          <?php 
ngWordForDm($val['content']);
  global $includeNgWordForDm;

if(0 === $includeNgWordForDm):

  ChangeWordDm($val['content'],$userInfo['name'],$userInfo['truename']);

else:
  echo "<span class='ngWords'>【テキストは非表示です。管理者が返信後にご返信ください】</span>";
endif;
           ?>
      </p>
    </div>

  

<?php endif ?>

<?php
  endforeach; ?>


<!-- </ul> -->

</div>












    
      <div class="talkBlock approvalBlock">
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize">【1on1】No.<?php echo $key +1 ?></h3>
      </div>

    </div>
    <div class="textBlock">
      <p>
    

<textarea maxlength="120" name="message"><?php echo $value['content']; ?></textarea>
      </p>
    </div>

    <div class="btnBlock btnFlex">
      <?php 
if($auth_user == $master_user):
       ?>
      <div class="btnFlex2 no1">
        <button name="check"  value="true" onclick="return confirm_post()">
          承認する
        </button>
      </div>
    <?php endif; ?>
            <div class="btnFlex2 no2">
                      <button name="check"  value="false" onclick="return confirm_delete()">
          削除する
        </button>
      </div>
    </div>
  </div>
  </div>
   <input type="hidden" name="recipient_id" value="<?php echo $user_number ;?>">
   <input type="hidden" name="post_type" value="posted">
   <input type="hidden" name="database_id" value="<?php echo $value['id']; ?>">

</form>






  </div>

<?php
  endforeach; ?>