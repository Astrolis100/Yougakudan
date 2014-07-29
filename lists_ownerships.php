<?php 

include("oauth.php"); 

$page_title = "リストオーナーシップ"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $param["cursor"] = !empty($_GET["cursor"]) ? $_GET["cursor"] : -1 ; 
 $json = $object->request("GET","lists/ownerships",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json->lists as $list) 
  { 
   $name = $list->user->name; 
   $screen_name = $list->user->screen_name; 
   $profile_image_url = str_replace("_normal.",".",$list->user->profile_image_url_https); 
   $list_name = $list->name; 
   $list_id_str = $list->id_str; 
   $member_count = $list->member_count; 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_image_url ?>" class="icon"> 
</a> 
</td> 
<td class="wide"> 
<a href="lists_show?list_id=<?= $list_id_str ?>"> 
<span class="bold"><?= $name ?></span>　<span class="small"><?= $screen_name ?></span><br> 
<?= $list_name ?><br> 
<span class="small"><?= $member_count ?>人が登録されています</span><br> 
</a> 
</td> 
</tr> 
<?php 

  } 
  $next_cursor = $json->next_cursor_str; 
  $prev_cursor = $json->previous_cursor_str; 

?> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="?username=<?= $param["screen_name"] ?>&cursor=<?= $prev_cursor ?>" class="block">前のページ</a> 
</td> 
<td> 
<a href="?username=<?= $param["screen_name"] ?>&cursor=<?= $next_cursor ?>" class="block">次のページ</a> 
</td> 
</tr> 
</table> 
<?php 

 } 
 else 
 { 

?> 
エラーが発生しました<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>