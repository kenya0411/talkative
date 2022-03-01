<?php 


if ($post_type=='posted') {
    $url = $_SERVER["REQUEST_URI"];
 
if (strstr($url ,'?posted')==true) {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/posted.php');
}elseif (strstr($url ,'dm_checked')==true) {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_checked.php');

}elseif (strstr($url ,'dm_approval_checked')==true) {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_approval_checked.php');

}
}else{

}

if ($page_id=='tweetpost') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/tweetpost.php');

}elseif ($page_id=='response') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/response.php');
}elseif ($page_id=='dmlist') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_list.php');
}elseif ($page_id=='dmshow') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/dm/dm_show.php');

}elseif ($page_id=='hometimeline') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/hometimeline.php');

}elseif ($page_id=='timeline') {
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/timeline.php');

}elseif ($page_id=='mentionstimeline') {
    
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/mentionstimeline.php');
}elseif ($page_id=='postcount') {
    
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/postcount.php');

}elseif ($page_id=='approval') {
    
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/approval.php');

}elseif ($page_id=='approval_check') {
    
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/approval_check.php');

}else{
require_once($_SERVER['DOCUMENT_ROOT']  . '/components/timeline.php');

}


 ?>