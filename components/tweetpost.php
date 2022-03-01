<?php 
// if (!empty($_POST['reply_tweetid'])) {
// $reply_tweetid = $_POST['reply_tweetid'];
// }else{
// $reply_tweetid = "";

// }

 ?>


<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Talk Post</h2>
  </div>
</section>
 <section class="main maxWid mbPad postPage">



 



 
<div class="heading">
<h2>投稿フォーム</h2>
   
</div>
<form action="/user/<?php echo $userInfo['dir'] ?>/?posted" method="POST">
   <!-- <input type="hidden" name="reply_tweetid" value="<?php echo $reply_tweetid; ?>"> -->
   <input type="hidden" name="post_type" value="posted">

<textarea maxlength="120" name="message"></textarea><br>
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