<?
include_once $_SERVER['DOCUMENT_ROOT']."/inc/common.inc";
//include $_SERVER['DOCUMENT_ROOT']."/inc/mem_info.inc";

$sql = "select id from tb_users where strID='$strID'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$total = mysqli_num_rows($result);

$sql = "select id from wiz_admin where id = '$strID'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$total2 = mysqli_num_rows($result);



if($strID != ""){
	if($total > 0){
		$checkmsg = "<font color=#00BCBC><b>".$strID."</b></font> 는 이미 사용중인 파트너코드 입니다.";
	} else if($total2 > 0) {
		$checkmsg = "<font color=#00BCBC><b>".$strID."</b></font> 는 사용할 수 없는 파트너코드 입니다.";
	} else{
		$checkmsg = "<font color=#00BCBC><b>".$strID."</b></font> 는 사용가능한 파트너코드 입니다. <a class='AW-btn' onClick='setId()'>사용하기</a>";
	}
}else{
	$checkmsg = "사용하고자 하는 파트너코드를 입력하세요";
}
?>
<html>
<head>
<title>아이디 중복체크</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./style.css" rel="stylesheet" type="text/css">
<!-- <script language="JavaScript" src="../js/util_lib.js"></script> -->
<script language="JavaScript">
<!--

// 입력값 체크
function inputCheck(frm){
	
	if(frm.strID.value.length < 3 || frm.strID.value.length > 12){
		alert("아이디는 3 ~ 12자리만 가능합니다.");
		frm.strID.focus();
		return false;
	}else{
		if(!Check_Char(frm.id.value)){
			alert("아이디는 특수문자를 사용할수 없습니다.");
			frm.strID.focus();
			return false;
		}
   }

}
// 아이디 입력폼으로 전송
function setId(){
	opener.frm.<?=$name?>.value = '<?=$strID?>';
	self.close();
}
//-->
</script>
</head>

<body onLoad="document.frm.id.focus();">
	
<table width="100%" cellpadding=10 cellspacing=0><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 아이디 검색</td>
  </tr>
</table>
<table width="100%"cellpadding=2 cellspacing=1 class="t_style">
<form name="frm" method="post" action="<?=$PHP_SELF?>" onSubmit="return inputCheck(this)">
	<input type=hidden name=name value="<?=$name?>">
  <tr>
    <td height=25 width="100" class="t_name" align="center">아이디</td>
    <td class="t_value">
      <input type="text" name="strID" class="input" size="20" value="<?=$strID?>">
      <input type="submit" value=" 검 색 " class="btn-zipcode"/>
    </td>
  </tr>
</form>
</table>
<br>

<table border=0 cellpadding=2 cellspacing=0 width=100% bgcolor=#ffffff align=center>
	<tr>
	  <td colspan="2" align="center"><?=$checkmsg?></td>
	</tr>
</table>	

</td></tr></table>
</body>
</html>