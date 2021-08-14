<?
@extract($_SESSION);
@extract($_COOKIE);

if(!empty($wiz_mall['id'])){

	setcookie("wiz_mall['id']", "", time()-3600, "/");
	setcookie("wiz_mall[name]", "", time()-3600, "/");
	setcookie("wiz_mall[email]", "", time()-3600, "/");
}

echo "<script>parent.document.location='./admin_login.php';</script>";

?>