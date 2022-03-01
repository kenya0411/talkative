<?php 
if (!empty($_GET['post_id'])) {
$post_id = $_GET['post_id'];
$post_name = $_GET['post_name'];
}else{
$post_id = "";
$post_name = "";

}
 ?>


<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Talk Post</h2>
  </div>
</section>
 <section class="main maxWid mbPad postPage">



 

<?php 

//Twitter REST API 呼び出し
$code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/show.json",array("id"=>$post_id));
 
// statuses/home_timeline.json の結果をjson文字列で受け取り配列に格納
$aResData = json_decode($twObj->response["response"], true);
 
//配列を展開
if(isset($aResData['errors']) && $aResData['errors'] != ''){
echo "取得に失敗しました。";
}else{

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


};
 ?>
 




<div class="heading">
<h2>投稿フォーム</h2>
   
</div>
<form action="/user/<?php echo $userInfo['dir'] ?>/?posted" method="POST">
   <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
   <input type="hidden" name="post_name" value="<?php echo $post_name; ?>">
   <input type="hidden" name="post_type" value="posted">
<textarea maxlength="120" name="message"></textarea>

<?php 
if ($userInfo['require'] == 'hidden') :
 ?>
   <input type="checkbox" name="post_check" id="post_check" value="true" checked style="display: none;">
<?php 
elseif ($userInfo['require'] == 'check') :

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
 
 </section>