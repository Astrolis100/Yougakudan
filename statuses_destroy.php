<?php 

include("oauth.php"); 

$page_title = "ツイートの削除"; 
include("head.php"); 

if(isset($_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $id = $_GET["id"]; 
 $object = new oauth(); 
 $json = $object->request("POST","statuses/destroy/" . $id); 
 if(empty($json->errors)) 
 { 

?> 
ツイートを削除しました<br> 
<br> 
<?= $json->text ?><br> 
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
<input type="text" name="id" class="input_text" placeholder="ツイートＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>