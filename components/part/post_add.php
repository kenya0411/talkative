<?php 

//通常のツイートの場合
     if(empty($post_id)){

           $code = $twObj->request( 'POST', "https://api.twitter.com/1.1/statuses/update.json",array("status" => $sTweet));
     }else{
         $sTweet= $post_name.$sTweet;

//リプライの場合
           $code = $twObj->request( 'POST', "https://api.twitter.com/1.1/statuses/update.json",array("status" =>  $sTweet,"in_reply_to_status_id"=>$post_id));
     }


// statuses/update.json の結果をjson文字列で受け取り配列に格納
     $aResData = json_decode($twObj->response["response"], true);
//配列を展開
     if(isset($aResData['errors']) && $aResData['errors'] != ''){
        ?>
        投稿に失敗しました。<br/>
        <?php
    }else{

    }
 ?>