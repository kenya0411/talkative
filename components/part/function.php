
<?php 
require_once('ngword.php');

//Tweet情報の変数
function twitterInfo($aResData,$iTweet){
  global $twitterInfo,$create_date;
  //日付を日本用にする
  createDate($aResData,$iTweet);

  if($iTweet===""){

    $twitterInfo = array(
      "twitter_id" => $aResData['id'],
      "user_id" => $aResData['user']['id'],
      "name" => $aResData['user']['name'],
      "screen_name" => $aResData['user']['screen_name'],
      "text" => $aResData['text'],
      "replyId" => $aResData['in_reply_to_status_id'],
      "source" => strip_tags($aResData['source']),
      "oridinalAt" => $aResData['created_at'],
      "sCreatedAt" => $create_date,
    );
  }else{
    $twitterInfo = array(
      "twitter_id" => $aResData[$iTweet]['id'],
      "user_id" => $aResData[$iTweet]['user']['id'],
      "name" => $aResData[$iTweet]['user']['name'],
      "screen_name" => $aResData[$iTweet]['user']['screen_name'],
      "text" => $aResData[$iTweet]['text'],
      "replyId" => $aResData[$iTweet]['in_reply_to_status_id'],
      "source" => strip_tags($aResData[$iTweet]['source']),
      "oridinalAt" => $aResData[$iTweet]['created_at'],

      "sCreatedAt" => $create_date,
    );
  }
}

//--------------------------------------------------- 
// for timeline
//--------------------------------------------------- 



//ツイート履歴のhtmlを出力
function htmlOutPut($name,$twitterInfo){
  global $outputText,$includeNgWord,$userInfo;
exclusionText($twitterInfo['text']);//除外設定
$twitterInfo['text'] = $outputText;

//ngWordが含まれていたら表示しない
ngWord($twitterInfo['text']);//NGWORD設定
if(0 === $includeNgWord):

  if (!empty($_GET['page_id'])) {
    $page_id = $_GET['page_id'];
  }else{
    $page_id = "";
  }

  ?>
  <div class="talkBlock">
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize"><?php echo $name ?>様</h3>
        <div class="timeSize"><?php echo $twitterInfo['sCreatedAt']; ?></div>
      </div>
      <div class="replyBlock nowPage_<?php echo $page_id ?>">
        <div class="btn">

          <a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=response&post_id=<?php echo $twitterInfo['twitter_id']; ?>&post_name=<?php echo $twitterInfo['screen_name']; ?>">

            <span>返信</span>
            <img src="/common/img/icon/icon-response.svg" class=" replyIcon" alt="返信"/>

          </a>
        </div>

      </div>
    </div>
    <div class="textBlock">
      <p>
        <?php echo nl2br($twitterInfo['text']); ?>
      </p>
    </div>
  </div>

  <?php
endif;
}



?>






<?php



//返信用のオリジナルTweetの情報を出力
function originalInfo($twObj,$iTweet,$aResData){
  global $originalInfo,$create_date;

//Twitter REST API 呼び出し
  if($iTweet===""){
    $originalTweet = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/show.json",array("id"=>$aResData['in_reply_to_status_id']));

  }else{
    $originalTweet = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/show.json",array("id"=>$aResData[$iTweet]['in_reply_to_status_id']));

  }
  $oridinalData = json_decode($twObj->response["response"], true);
  if(isset($oridinalData['errors']) && $oridinalData['errors'] != ''){
  }else{
       //日付を日本用にする
    createDate($oridinalData,'');
    $originalInfo = array(
      "twitter_id" => $oridinalData['id'],
      "user_id" => $oridinalData['user']['id'],
      "name" => $oridinalData['user']['name'],
      "screen_name" => $oridinalData['user']['screen_name'],
      "text" => $oridinalData['text'],
      "sCreatedAt" => $create_date,
    );   
  }

};


//ツイートとリプライのhtmlを出力
function responseOutPut($name,$twitterInfo,$originalInfo){
  global $outputText,$includeNgWord,$names,$userInfo,$originalName;

exclusionText($originalInfo['text']);//除外設定
$originalInfo['text'] =$outputText;

exclusionText($twitterInfo['text']);//除外設定
$twitterInfo['text'] =$outputText;

//ngWordが含まれていたら表示しない
ngWord($originalInfo['text']);//NGWORD設定
if(0 === $includeNgWord):

  //ngWordが含まれていたら表示しない
ngWord($twitterInfo['text']);//NGWORD設定

if(0 === $includeNgWord):

  if (!empty($_GET['page_id'])) {
    $page_id = $_GET['page_id'];
  }else{
    $page_id = "";
  }
$originalName =$name;

  nameChange($twitterInfo,$originalInfo);
  //Reply元の名前を変更
if($name == $userInfo['truename']){
  $name = $userInfo['name'];
}

  
  ?>
  <div class="talkBlock originalBlock">
    <div class="upper">
      <div class="nameBlock">
        <h3 class="nameSize"><?php echo $originalName; ?>様</h3>
        <div class="timeSize"><?php echo $originalInfo['sCreatedAt']; ?></div>
      </div>

    </div>
    <div class="textBlock">
      <p>
        <?php echo nl2br($originalInfo['text']); ?>
      </p>
    </div>

    <div class="responseBlock">
      <div class="upper">
        <div class="nameBlock">
          <h3 class="nameSize"><?php echo $names ?>様</h3>
          <div class="timeSize"><?php echo $twitterInfo['sCreatedAt'] ?></div>
        </div>
        <div class="replyBlock nowPage_<?php echo $page_id ?>">
          <div class="btn">

            <a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=response&post_id=<?php echo $twitterInfo['twitter_id']; ?>&post_name=<?php echo $twitterInfo['screen_name']; ?>">

              <span>返信</span>
              <img src="/common/img/icon/icon-response.svg" class=" replyIcon" alt="返信"/>

            </a>
          </div>

        </div>
      </div>
      <div class="textBlock">
        <p>
          <?php echo nl2br($twitterInfo['text']); ?>
        </p>
      </div>
    </div>
  </div>


  <?php


endif;
endif;
}
?>





<?php 

//リプライの文字を抽出し、除外
function exclusionText($text){
  global $outputText;

  $start = mb_strpos($text,'@');
  $end = mb_strpos($text,' ');
  $replyName = mb_substr($text, $start, $end-$start, "utf-8");
  $outputText = str_replace($replyName, "", $text);

}

  //日付を日本用にする
function createDate($aResData,$iTweet){
  global $create_date;
  if($iTweet===""){
   $create_date = new DateTime($aResData['created_at']);
   $create_date = $create_date->setTimezone(new DateTimeZone('Asia/Tokyo'));
   $create_date = $create_date->format('m月d日 H時i分'); 

 }else{
  $create_date = new DateTime($aResData[$iTweet]['created_at']);
  $create_date = $create_date->setTimezone(new DateTimeZone('Asia/Tokyo'));
  $create_date = $create_date->format('m月d日 H時i分');
}
}



//名前変更
function nameChange($twitterInfo,$originalInfo){
  global $names,$originalName, $userInfo;
  if($twitterInfo['user_id'] == $userInfo['id']){
    $names = $userInfo['name'];
  }else{
    $names = mb_substr($twitterInfo['name'], 0, 2,"utf-8")."-".mb_substr($twitterInfo['screen_name'], 4, 6,"utf-8");
  }


  if($originalInfo['user_id'] == $userInfo['id']){
    $originalName = $userInfo['name'];
  }else{
    $originalName = mb_substr($originalInfo['name'], 0, 2,"utf-8")."-".mb_substr($originalInfo['screen_name'], 4, 6,"utf-8");
  }

}
//名前変更(汎用的)

function nameChangeAll($names,$screen_name){
  global $fakeName;

    $fakeName = mb_substr($names, 0, 2,"utf-8")."-".mb_substr($screen_name, 4, 6,"utf-8");


}



//ソート
function sortByKey($key_name, $sort_order, $array) {
  $standard_key_array = array();
    foreach ($array as $key => $value) {
        $standard_key_array[$key] = $value[$key_name];
    }

    array_multisort($standard_key_array, $sort_order, $array);

    return $array;
}


?>