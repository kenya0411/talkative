<?php 
require_once($_SERVER['DOCUMENT_ROOT']  . "/function/variable.php");
require_once($_SERVER['DOCUMENT_ROOT']  . "/components/part/database.php");

$word = $_POST['word'];


  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->exec("INSERT INTO nglist (word)
      VALUES ('$word')");
  } catch (PDOException $e) {
    print '書き込みできませんでした' . $e->getMessage();
  }

unset($pdo);
 ?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta name="description" content="" />
    <meta name="Keywords" content="" />
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/header.php"); ?>
    <META http-equiv="Refresh" content="0;URL=./">
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/nav.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/footnav.php"); ?>

    <main>
        
<section class="mainTitle">
  <div class="maxWid mbPad">
    <h2>NgList</h2>
  </div>
</section>
 <section class="main maxWid mbPad">
投稿完了しました。
</section>
    </main>


    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/footer.php"); ?>
