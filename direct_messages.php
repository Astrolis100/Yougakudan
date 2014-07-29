<?php 

include("oauth.php"); 

$page_title = "受信済みメッセージ"; 
include("head.php"); 

$object = new oauth(); 
$param["count"] = 100; 
$json = $object->request("GET","direct_messages",$param); 
if(empty($json->errors)) 
{ 

?> 
<table class="list"> 
<?php 

 foreach($json as $list) 
 { 
  $name = $list->sender->name; 
  $screen_name = $list->sender->screen_name; 
  $profile_image_url = str_replace("_normal.",".",$list->sender->profile_image_url_https); 
  $text = str_replace("\n","<br>\n",$list->text); 
  $id_str = $list->id_str; 
  $created_at = date("Y年m月d日H時i分s秒",strtotime($list->created_at)); 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_image_url ?>" class="icon"> 
</a> 
</td> 
<td class="wide"> 
<a href="direct_messages_show?id=<?= $id_str ?>"> 
<span class="bold"><?= $name ?></span>　<span class="small"><?= $screen_name ?></span><br> 
<?= $text ?><br> 
<span class="small"><?= $created_at ?></span><br> 
</a> 
</td> 
</tr> 
<?php 

 } 

?> 
</table> 
<?php 

} 
else 
{ 

?> 
エラーが発生しました<br> 
<?php 

} 

include("foot.php"); 

?>