

<?php
 require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');
$test_message = $_POST['message'];
$userId = $_POST['recipient_id'];
$today = date("m月d日 H時i分");
// 2.実行したいSQL文をセットする。
// $stmt = $pdo->prepare('SELECT * FROM post_content WHERE id = '.$id );
// $stmt = $pdo->prepare('SELECT * FROM post_content WHERE content = :content LIMIT 1');

// 3.SQLに対してパラメーターをセットする。【任意】
// $stmt->bindValue(':content', $sTweet, PDO::PARAM_STR);

// 4.実際にSQLを実行する。
// $stmt->execute();

// 5.結果を取得する。【任意】
// $post_content = $stmt->fetch();
  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->exec("INSERT INTO post_content (twitter_id, content, post_date,user_id,approval,status)
      VALUES ('$recipient_id', '$test_message', '$today','$userid','yet','dm')");
  } catch (PDOException $e) {
    print '書き込みできませんでした' . $e->getMessage();
  }
  
// if(empty($post_content)){
//   try {
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $q = $pdo->exec("INSERT INTO post_content (reply_id, content,approval)
//       VALUES ('$post_id', '$sTweet','yet')");
//   } catch (PDOException $e) {
//     print '書き込みできませんでした' . $e->getMessage();
//   }
// }else{

// }

// try {
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $q = $pdo->prepare("DELETE FROM post_content WHERE content = :content");
//   $q->bindParam( ':content', $content, PDO::PARAM_INT);
//   $res = $q->execute();
// } catch (PDOException $e) {
//   print '削除できませんでした' . $e->getMessage();
// }


// 6.データーベースから切断する。
unset($pdo);
?>
