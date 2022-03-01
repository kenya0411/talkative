<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>Post Count</h2>
  </div>
</section>
<section class="main maxWid mbPad">


  <?php
  $count = [];
 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');

 //Twitter REST API 呼び出し
  $code = $twObj->request( 'GET', "https://api.twitter.com/1.1/statuses/user_timeline.json",array("count"=>"100","user_id"=> $userInfo['id']));
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
    

    if ($twitterInfo['source'] == $userInfo['source']) {

     $create_date = new DateTime($twitterInfo['oridinalAt']);
     $create_date = $create_date->setTimezone(new DateTimeZone('Asia/Tokyo'));
     $create_date = $create_date->format('Y年m月d日');
     if(empty($count[$create_date] )){
       $count[$create_date] = 1;

     }else{
       $count[$create_date] = $count[$create_date] + 1;

     }

   }


   $twitterInfo['name'] = $userInfo['name'];
   if(empty($twitterInfo['replyId'])){


   }else{

    if(empty( $originalInfo['text'])){
    }
    else{
      responseOutPut($originalInfo['name'],$twitterInfo,$originalInfo);
    }


  }




 }//end for
}

$this_month = date("m");
$prev_month = date("m", strtotime('-1 month'));
$this_month_count = 0;
$prev_month_count = 0;

?>

<table class="postCount">
      <tr class="headTable">
<th>日付</th>
<td>投稿回数</td>    

    </tr>
  <?php 
  $count_num = 0;
  foreach ($count as $key => $value) :
  $count_num = $count_num +1;
  if($count_num <= 30):
    ?>
    <tr>
<th><?php echo $key ?></th>
<td><?php echo $value ?>回

<?php echo '<pre>';
if (strstr($key , $this_month.'月')==true) {
  $this_month_count = $this_month_count +$value ;

}elseif(strstr($key , $prev_month.'月')==true){
$prev_month_count = $prev_month_count +$value;
}
echo '</pre>'; ?>
</td>   


    </tr>
  <?php endif; ?>

  <?php endforeach; ?>
  <tr>
    
  <th><?php echo $prev_month ?>月合計</th>
<td><?php echo $prev_month_count ?>回</td>
  </tr>
<tr>
  
<th><?php echo $this_month ?>月合計</th>
<td><?php echo $this_month_count ?>回</td>
</tr>

</table>

<?php 
$this_month_count = 0;
$prev_month_count = 0;
 ?>
<p style="margin-top: 50px;"></p>

<table class="postCount">
      <tr class="headTable">
<th>日付</th>
<td>1on1投稿回数</td>    
    </tr>
  <?php 
  $today = date("Y年m月d日");
  // $count_num = 0;

  // getDatabase($pdo,$userInfo['source_app_id']);
  // global $direct_message;

for ($i=1; $i <30 ; $i++) 

  :?>

    <tr>
<th><?php echo $today ?></th>
<td><?php countDm($pdo,$userInfo['source_app_id'],$today) ?>

</td>   


    </tr>

<?php $today =  date("Y年m月d日", strtotime("-".$i." day")) ;?>

<?php endfor;?>
  <tr>
    
  <th><?php echo $prev_month ?>月合計</th>
<td><?php echo $prev_month_count ?>回</td>
  </tr>
<tr>
  
<th><?php echo $this_month ?>月合計</th>
<td><?php echo $this_month_count ?>回</td>
</tr>
</table>


</section>

<?php 

// getDatabase($pdo,$userInfo['source_app_id']);
//   global $direct_message;
// date_default_timezone_set('Asia/Tokyo');
// $created_timestamp = $value2['created_timestamp']/1000;
// $created_timestamp = date("Y年m月d日",$created_timestamp);

 ?>



<?php 
function countDm($pdo,$userInfo,$key){

  global $direct_message;
  global $this_month_count;
  global $prev_month_count;
  $this_month = date("m");
$prev_month = date("m", strtotime('-1 month'));
getDatabase($pdo,$userInfo);

$number = 0;
// countDm($pdo,$userInfo['source_app_id']);
// global $direct_message;
foreach ($direct_message as $key2 => $value2) {
 
date_default_timezone_set('Asia/Tokyo');
$created_timestamp = $value2['created_timestamp']/1000;
$created_timestamp = date("Y年m月d日",$created_timestamp);

if($key ==$created_timestamp){
$number = $number + 1;
}
}
echo $number.'回';

if (strstr($key , $this_month.'月')==true) {
  $this_month_count = $this_month_count +$number ;
}elseif(strstr($key , $prev_month.'月')==true){
$prev_month_count = $prev_month_count +$number;

}; 

}



function getDatabase($pdo,$userInfo){
  global $direct_message;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$where = 'WHERE source_app_id = '.$userInfo;
$stmt = $pdo->prepare('select * FROM direct_message '.$where);
$stmt->execute();
// 5.結果を取得する。【任意】
$direct_message = [];
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){ $direct_message[] = $row;}
}

 ?>
