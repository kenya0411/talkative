<?php 
require_once($_SERVER['DOCUMENT_ROOT']  . "/function/variable.php");

require_once($_SERVER['DOCUMENT_ROOT']  . "/components/part/database.php");

require_once($_SERVER['DOCUMENT_ROOT']  . "/components/part/ngword.php");

$stmt = $pdo->prepare('SELECT * FROM nglist');
$stmt->execute();
$rows = ''; 
$ngGet=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach((array)$rows as $row){ print_r($row);}
foreach((array)$rows as $row){ print_r($row);}

unset($pdo);


 ?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta name="description" content="" />
    <meta name="Keywords" content="" />
    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/header.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
 <section class="main maxWid mbPad ">
<div class="btn-group mb-5" role="group" aria-label="Basic example">
	<a href="/user/aya/" class="btn btn-outline-secondary">aya</a>
	<a href="/user/you" class="btn btn-outline-secondary">you</a>
</div>

<p class="h2">NGリスト</p>
<?php 
foreach ($ngGet as $key => $value) :?>

<form action="./edit.php" method="post">


  <div class="mb-3">
    <div class="d-flex ">
      <input type="hidden" class="form-control" name="id" value="<?php echo $value["id"] ?>">

      <input type="text" class="form-control w-25" name="word"value="<?php echo $value["word"] ?>">
      <button type="submit" class="ms-5 btn btn-secondary">編集</button>
    </div>
  </div>

  
</form>

<?php endforeach;
ngWordForDm('test');
 ?>

</section>

 <section class="main maxWid mbPad">
<p class="h2 mt-5">NGワード新規追加</p>

 	<form action="./thank.php" method="post">


  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">NGワード</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="word">
    </div>
  </div>


  <button type="submit" class="btn btn-primary">送信する</button>
</form>
</section>
    </main>


    <?php require_once($_SERVER['DOCUMENT_ROOT']  . "/common/footer.php"); ?>
