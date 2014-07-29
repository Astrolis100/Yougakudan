<?php 

include("oauth.php"); 

$page_title = "ミュート解除"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("POST","mutes/users/destroy",$param); 
 if(empty($json->errors)) 
 { 

?> 
<?= $json->name . "(" . $json->screen_name . ")" ?>をミュート解除しました<br> 
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