<?php 


$stmt = $pdo->prepare('SELECT * FROM post_content WHERE approval = :approval AND user_id = :user_id AND status = :tweet');
$stmt->bindValue(':approval', 'yet', PDO::PARAM_STR);
$stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
$stmt->bindValue(':tweet','tweet', PDO::PARAM_STR);
$stmt->execute();
$rows = ''; 
$post_content=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach((array)$rows as $row){ print_r($row);}
foreach((array)$rows as $row){ print_r($row);}


if( $post_content ) {

  foreach ($post_content as $key => $value) :?>

    <?php if (empty($value['reply_id'])): ?>
<form action="/user/<?php echo $userInfo['dir'] ?>/?page_id=approval_check"  method="POST">
  <div class="approvalWrap">
    
      <div class="talkBlock approvalBlock">
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize">No.<?php echo $key +1 ?>【投稿】</h3>
        <div class="timeSize">  [<?php echo $value['post_date']; ?>]</div>
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

                  <input type="hidden" name="post_id" value="<?php echo $value['reply_id']; ?>">
   <input type="hidden" name="post_type" value="posted">
   <input type="hidden" name="database_id" value="<?php echo $value['id']; ?>">
</form>



<?php else:?>
<form action="/user/<?php echo $userInfo['dir'] ?>/?page_id=approval_check"  method="POST">
<div class="approvalWrap">
  
  <?php
$code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/show.json",array("id"=>$value['reply_id']));
 
// statuses/home_timeline.json の結果をjson文字列で受け取り配列に格納
$aResData = json_decode($twObj->response["response"], true);
   $iCount = sizeof($aResData);
$iTweet= '';
    twitterInfo($aResData,$iTweet);
    originalInfo($twObj,$iTweet,$aResData);

    if(empty( $originalInfo['text'])){
      if($twitterInfo['user_id'] == $userInfo["id"]){
        $twitterInfo['name'] = $userInfo['name'];
    }
      htmlOutPut($twitterInfo['name'],$twitterInfo);
    }

    else{
      
      if($originalInfo['user_id'] == $userInfo["id"]){

        responseOutPut($userInfo['name'],$twitterInfo,$originalInfo);
      }
    }

 ?>
      <div class="talkBlock approvalBlock">
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize">【投稿】No.<?php echo $key +1 ?></h3>
        <div class="timeSize">  [<?php echo $value['post_date']; ?>]</div>
      </div>

    </div>
    <div class="textBlock">
      <p>
    

<textarea maxlength="120" name="message"><?php echo $value['content']; ?></textarea>
      </p>
    </div>

    <div class="btnBlock btnFlex">
      <div class="btnFlex2 no1">
        <button name="check"  value="true" onclick="return confirm_post()">
          承認する
        </button>
      </div>
            <div class="btnFlex2 no2">
                      <button name="check"  value="false" onclick="return confirm_delete()">
          削除する
        </button>
      </div>
    </div>
  </div>
   <input type="hidden" name="post_name" value="<?php echo $twitterInfo['screen_name'];; ?>">
     <input type="hidden" name="post_id" value="<?php echo $value['reply_id']; ?>">
   <input type="hidden" name="post_type" value="posted">
   <input type="hidden" name="database_id" value="<?php echo $value['id']; ?>">
</div>
</form>
<?php endif; ?>







<?php
  endforeach;

}
 ?>