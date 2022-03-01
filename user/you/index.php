<?php 
require_once($_SERVER['DOCUMENT_ROOT']  . "/function/variable.php");

require_once($_SERVER['DOCUMENT_ROOT']  . "/function/tmhOAuth.php");
require_once("./config.php");
  require_once($_SERVER['DOCUMENT_ROOT']  . '/components/part/function.php');

  
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta name="description" content="" />
    <meta name="Keywords" content="" />
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/header.php"); ?>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/nav.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/footnav.php"); ?>

    <main>
        
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT']  . '/components/page.php')
        ?>
    </main>


    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/footer.php"); ?>
