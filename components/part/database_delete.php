

<?php
$database_id = $_POST['database_id'];

     require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/database.php');

  
if(!empty($database_id )){
  
try {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $q = $pdo->prepare("DELETE FROM post_content WHERE id = :id");
  $q->bindParam( ':id', $database_id, PDO::PARAM_INT);
  $res = $q->execute();
} catch (PDOException $e) {
  print '削除できませんでした' . $e->getMessage();
}

}

// 6.データーベースから切断する。
unset($pdo);
?>
