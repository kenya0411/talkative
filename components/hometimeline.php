<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Talk Room</h2>
  </div>
</section>
 <section class="main maxWid mbPad">



<?php
//Twitter REST API 呼び出し
$code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/home_timeline.json",array("count"=>"10"));
 
// statuses/home_timeline.json の結果をjson文字列で受け取り配列に格納
$aResData = json_decode($twObj->response["response"], true);
 
//配列を展開
if(isset($aResData['errors']) && $aResData['errors'] != ''){
 ?>
 取得に失敗しました。<br/>
 エラー内容：<br/>
 <pre>
 <?php var_dump($aResData); ?>
 </pre>
<?php
}else{
 //配列を展開
 $iCount = sizeof($aResData);
 for($iTweet = 0; $iTweet<$iCount; $iTweet++){
 $iTweetId =                 $aResData[$iTweet]['id'];
 $sIdStr =                   (string)$aResData[$iTweet]['id_str'];
 $sText=                     $aResData[$iTweet]['text'];
 $sName=                     $aResData[$iTweet]['user']['name'];
 $sScreenName=               $aResData[$iTweet]['user']['screen_name'];
 $sProfileImageUrl =         $aResData[$iTweet]['user']['profile_image_url'];
 $sCreatedAt =               $aResData[$iTweet]['created_at'];
 $sStrtotime=                strtotime($sCreatedAt);
 $sCreatedAt =               date('Y-m-d H:i:s', $sStrtotime);
 ?>
 <hr/>
   

 <h3><?php echo $sName; ?>さんのつぶやき</h3>
 <ul>
 <li>IDNO[id] : <?php echo $iTweetId; ?></li>
 <li>名前[name] : <?php echo $sIdStr; ?></li>
 <li>スクリーンネーム[screen_name] : <?php echo $sScreenName; ?></li>
 <li>プロフィール画像[profile_image_url] : <img src="<?php echo $sProfileImageUrl; ?>" /></li>
 <li>つぶやき[text] : <?php echo $sText; ?></li>
 <li>ツイートタイム[created_at] : <?php echo $sCreatedAt; ?></li>
 </ul>
<?php
 }//end for
}
?>
  </section>
