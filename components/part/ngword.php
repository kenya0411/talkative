<?php

function ngWord($text){
	global $includeNgWord;
$addSlash = "/";

//NGWORDリスト
$ngList = array(
  $addSlash.
  'http',
  'ツイート',
  'リツイート',
  'オフパコ',
  'DM',
  'RT',
  'ファボ',
  'らぶりつ',
  'ラブリツ',
  'ＤＭ',
  'フォロバ',
  'ﾌｫﾛﾊﾞ',
  'Twitter',
  'twitter',
  'ついったー',
  'ツイッター',
  'フォロワー'
  .$addSlash 
);



$ngWord = implode('|',$ngList);
$includeNgWord = preg_match($ngWord, $text);
}


function ngWordForDm($text){
require($_SERVER['DOCUMENT_ROOT']  . "/components/part/database.php");

$stmt = $pdo->prepare('SELECT * FROM nglist');

$stmt->execute();
$rows = ''; 
$ngGet=$stmt->fetchAll(PDO::FETCH_ASSOC);

  global $includeNgWordForDm;
$addSlash = "/";
$ngDb = [];

foreach ($ngGet as $key => $value) {
  if($key==0){
  $ngDb[] =$addSlash.$value['word'];

  }elseif(end($ngGet)['word'] == $value['word']){
  $ngDb[] =$value['word'].$addSlash;

  }
  else{
  $ngDb[] =$value['word'];

  }
}

// echo '<pre>';
// var_dump($ngDb);
// echo '</pre>';
//NGWORDリスト
// $ngList = array(
//   $addSlash.
//   '欲しいものリスト',
//   'paypay',
//   '0円',
//   '０円',
//   'お金',
//   '欲しい物',
//   'アマゾン',
//   'amazon',
//   'あまぞん',
//   'お小遣い',
//   // 'リツイート',
//   // 'オフパコ',
//   // 'DM',
//   // 'RT',
//   // 'ファボ',
//   // 'らぶりつ',
//   // 'ラブリツ',
//   // 'ＤＭ',
//   // 'フォロバ',
//   // 'ﾌｫﾛﾊﾞ',
//   // 'Twitter',
//   // 'twitter',
//   // 'ついったー',
//   // 'ツイッター',
//   'http'
//   .$addSlash 
// );


// echo '<pre>';
// var_dump($ngList);
// echo '</pre>';

$ngList = $ngDb;
$ngWord = implode('|',$ngList);
$includeNgWordForDm = preg_match($ngWord, $text);
}


function ChangeWordDm($text,$user_name,$user_truename){
  global $ChangeWordDm;
$table = array(
  'DM'=>'メッセージ',
  'ＤＭ'=>'メッセージ',
  'ツイート'=>'投稿',
    'ツイ'=>'投稿',
      'ついーと'=>'投稿',
        'ﾂｲｰﾄ'=>'投稿',
  '固ツイ'=>'プロフ',
    'リプライ'=>'返信',
  'リプ'=>'返信',
  'ﾘﾌﾟ'=>'返信',
  'シャドバ'=>'バグ',
  'フォロバ'=>'ファン返し',
  'ﾌｫﾛﾊﾞ'=>'ファン返し',
  'Twitter'=>'',
  'twitter'=>'',
  'ついったー'=>'',
  'ツイッター'=>'',
  'ラブリツ'=>'',
  'らぶりつ'=>'',
  'フォロワー'=>'ファン',
  'ふぉろわー'=>'ファン',
  'ﾌｫﾛﾜｰ'=>'ファン',
  'ファボ'=>'お気に入り',
  'RT'=>'お気に入り',
        'tweet'=>'投稿',
  
  $user_truename=>$user_name,
);

$search = array_keys( $table);
$replace = array_values( $table);

echo str_replace($search,$replace,$text);

}







 ?>