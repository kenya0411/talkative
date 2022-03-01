<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>My Talk History</h2>
  </div>
</section>
<section class="main maxWid mbPad">


  <?php
  
 //Twitter REST API 呼び出し
  $code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/user_timeline.json",array("count"=>"50","user_id"=> $userInfo['id']));
 // statuses/home_timeline.json の結果をjson文字列で受け取り配列に格納
  $aResData = json_decode($twObj->response["response"], true);


//配列を展開
  if(isset($aResData['errors']) && $aResData['errors'] != ''){
   ?>
   取得に失敗しました。<br/>

   <?php
 }else{

 //配列を展開
   $iCount = sizeof($aResData);
   for($iTweet = 0; $iTweet<$iCount; $iTweet++){
    twitterInfo($aResData,$iTweet);
    originalInfo($twObj,$iTweet,$aResData);

    // htmlOutPut($userInfo['name'],$twitterInfo)
    
    $twitterInfo['name'] = $userInfo['name'];
    if(empty($twitterInfo['replyId'])){

if ($twitterInfo['source'] == $userInfo['source']){//talkativeで投稿したもののみ
  htmlOutPut($twitterInfo['name'],$twitterInfo);//通常の投稿を出力

}


}else{

  if(empty( $originalInfo['text'])){
  }
  else{
if ($twitterInfo['source'] == $userInfo['source']){//talkativeで投稿したもののみ

    responseOutPut($originalInfo['name'],$twitterInfo,$originalInfo);//返信の投稿を出力
  }
}


}




 }//end for
}

?>
</section>


