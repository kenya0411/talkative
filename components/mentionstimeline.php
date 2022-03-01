<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Message History</h2>
  </div>
</section>
<section class="main maxWid mbPad ">

  <?php
//tmhOAuth.phpをインクルードします。ファイルへのパスはご自分で決めて下さい。
 //関数


//Twitter REST API 呼び出し
  $code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/mentions_timeline.json",array("count"=>"50"));
  $aResData = json_decode($twObj->response["response"], true);
echo '<pre>';
var_dump($aResData);
echo '</pre>';
//配列を展開
  if(isset($aResData['errors']) && $aResData['errors'] != ''){
   echo "取得に失敗しました。";

 }else{
 //配列を展開
   $iCount = sizeof($aResData);
   for($iTweet = 0; $iTweet<$iCount; $iTweet++){

    twitterInfo($aResData,$iTweet);
    originalInfo($twObj,$iTweet,$aResData);

    if(empty( $originalInfo['text'])){
      // htmlOutPut($twitterInfo['name'],$twitterInfo);
    }

    else{
      
      if($originalInfo['user_id'] == $userInfo["id"]){

        responseOutPut($userInfo['name'],$twitterInfo,$originalInfo);
      }
    }

 }//end for
}
?>

</section>


<?php 


?>