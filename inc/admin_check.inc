<?
$wiz_admin = $_SESSION['wiz_admin'];

// 관리자 로그인 체크
if($wiz_admin['id'] == ""){
?>
<!--
<script language="javascript">
if(parent != null)
   parent.document.location = "/admin/admin_login.php";
else
   document.location = "/admin/admin_login.php";

</script>
-->
<?
}
?>