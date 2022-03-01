<?php 
// if (!empty($_POST['reply_tweetid'])) {
// $reply_tweetid = $_POST['reply_tweetid'];
// }else{
// $reply_tweetid = "";

// }

 ?>


<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Approval Post</h2>
  </div>
</section>
 <section class="main maxWid mbPad postPage">



 
<?php   

$user_id =$userInfo["id"];
$post_content = '';
$dm_content = '';
 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');






 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/tweet/approval_tweet.php');




 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_approval.php');

if( empty($post_content) &&  empty($dm_content)) {

  echo "<h3>承認依頼のメッセージはありません</h3>";
 }
 ?>


 






 
 </section>

 <script>
function confirm_post() {
    var select = confirm("承認しますか？");
    return select;
}
function confirm_delete() {
    var select = confirm("削除しますか？");
    return select;
}
</script>