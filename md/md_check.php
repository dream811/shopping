<?
include "../inc/common.inc";
include "../inc/util.inc";

$start_page = "./main/main.php";

if($admin_id == "") error("아이디를 입력하세요");
if($admin_pw == "") error("비밀번호를 입력하세요");

$sql = "select * from tb_users where strID='$admin_id'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$admin_info = mysqli_fetch_object($result);

if(password_verify($admin_pw, $admin_info->password)){

	if(strcmp($admin_info->status, "Y")) {

		error("관리자 승인 후 이용가능합니다.");

	} else {

	   //방문회수 증가
	   $sql = "update tb_users set last = now() where id='$admin_id'";
	   $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	   // 아이디 저장
	   if(isset($_POST['saveid']) && $_POST['saveid'] == "Y") setcookie("md_id", $md_id, time()+3600*24*365, "/");
		// $wiz_md['id'] 		= setcookie("wiz_md['id']", $admin_info->strID, false, "/");
		// $wiz_md['password'] = setcookie("wiz_md['password']", $admin_info->password, false, "/");
		// $wiz_md['name'] 	= setcookie("wiz_md['name']", $admin_info->com_name, false, "/");
		// $wiz_md['email'] 	= setcookie("wiz_md['email']", $admin_info->email, false, "/");
		// $wiz_md['com_tel'] 	= setcookie("wiz_md['com_tel']", $admin_info->com_tel, false, "/");

		$wiz_md['id'] 		= $_SESSION['wiz_md']['id'] = $admin_info->strID;
		$wiz_md['idx'] 		= $_SESSION['wiz_md']['idx'] = $admin_info->id;
		$wiz_md['password'] = $_SESSION['wiz_md']['password'] = $admin_info->password;
		$wiz_md['name'] 	= $_SESSION['wiz_md']['name'] = $admin_info->com_name;
		$wiz_md['email'] 	= $_SESSION['wiz_md']['email'] = $admin_info->email;
		$wiz_md['com_tel'] 	= $_SESSION['wiz_md']['com_tel'] = $admin_info->com_tel;
		Header("Location: $start_page");

	}

}  else{
	error("회원정보가 일치하지 않습니다.");
}

?>