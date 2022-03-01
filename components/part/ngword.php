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
  global $includeNgWordForDm;
$addSlash = "/";

//NGWORDリスト
$ngList = array(
  $addSlash.
  '欲しいものリスト',
  'paypay',
  '0円',
  '０円',
  'お金',
  '欲しい物',
  'アマゾン',
  'amazon',
  'あまぞん',
  'お小遣い',
  // 'リツイート',
  // 'オフパコ',
  // 'DM',
  // 'RT',
  // 'ファボ',
  // 'らぶりつ',
  // 'ラブリツ',
  // 'ＤＭ',
  // 'フォロバ',
  // 'ﾌｫﾛﾊﾞ',
  // 'Twitter',
  // 'twitter',
  // 'ついったー',
  // 'ツイッター',
  'http'
  .$addSlash 
);



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