<? include "../inc/common.inc"; ?>
<? include "../inc/util.inc"; ?>
<html>
<head>
<title>:: MD회원 가입 ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<link href="./style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function inputCheck(frm){

   if(frm.db_host.value == ""){
      alert("Mysql host 를 입력하세요");
      frm.db_host.focus();
      return false;
   }
   if(frm.db_name.value == ""){
      alert("Mysql name 를 입력하세요");
      frm.db_name.focus();
      return false;
   }
   if(frm.db_user.value == ""){
      alert("Mysql id 를 입력하세요");
      frm.db_user.focus();
      return false;
   }
   if(frm.db_pass.value == ""){
      alert("Mysql passwd 를 입력하세요");
      frm.admin_id.focus();
      return false;
   }

   if(frm.admin_id.value == ""){
      alert("관리자 아이디를 입력하세요");
      frm.admin_id.focus();
      return false;
   }

   if(frm.admin_pw.value == ""){
      alert("관리자 비밀번호를 입력하세요");
      frm.admin_pw.focus();
      return false;
   }

   if(frm.designer_id.value == ""){
      alert("디자이너 아이디를 입력하세요");
      frm.designer_id.focus();
      return false;
   }

   if(frm.designer_pw.value == ""){
      alert("디자이너 비밀번호를 입력하세요");
      frm.designer_pw.focus();
      return false;
   }

   if(frm.admin_id.value == frm.designer_id.value){

   	  alert("디자이너ID 와 관리자ID 를 동일하게 사용할 수 없습니다.");
      frm.admin_id.focus();
      return false;

   }

}
// 우편번호 찾기
function searchZip(kind) {
	
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
			// 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
			eval('document.frm.'+kind+'post').value = data.zonecode;
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    
					eval('document.frm.'+kind+'address').value = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)

					eval('document.frm.'+kind+'address').value = data.jibunAddress;
                   
                }

			//전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
			//아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
			//var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
			//document.getElementById('addr').value = addr;

			if(eval('document.frm.'+kind+'address2') != null)
				eval('document.frm.'+kind+'address2').focus();
		}
	}).open();
}

// 파트너코드 중복확인(하부회원용)
function partnerCheck(){
   var id = document.frm.strID.value;
   var url = "./partner_check.php?name=partner&strID=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}

// 추천인 중복확인
function preferCheck(){
   var id = document.frm.strID.value;
   var url = "./prefer_check.php?name=prefer&strID=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}
// 아이디 중복확인
function idCheck(){
   var id = document.frm.strID.value;
   var url = "./id_check.php?name=strID&strID=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}
-->
</script>
</head>
<body>
<table width="100%"  height="11" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  bgcolor="#3bc1c1">&nbsp;</td>
    <td width="222" bgcolor="#1c86cc"></td>
    <td width="2" bgcolor="#ffffff"></td>
    <td width="75" bgcolor="#AEAEAE"></td>
  </tr>
</table>

<table><tr><td height="100"></td></tr></table>
<table width="920" align="center" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit"><img src="./image/ic_tit.gif" align="absmiddle">심봉사 회원가입을 환영합니다<span style="font-size:12px; color:red;">*추천인이 없는 경우 최상위 추천인코드(0000)를 입력하세요</span></td>
  </tr>
</table>

<form style="width:920px; margin:auto;" name="frm" action="md_regist.php?" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
    <input type="hidden" name="tmp">
    <input type="hidden" name="mode" value="insert">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
            <tr>
              <td width="15%" class="t_name">추천인코드</td>
              <td width="35%" class="t_value">
              	<input name="prefer" type="text" value="" class="input" readonly>
              	<input type="button" value="체크" class="btn-zipcode" onCLick="preferCheck()" />
             	</td>
              <!-- <td width="15%" class="t_name">파트너코드</td>
              <td width="35%" class="t_value">
				<input name="partner" type="text" value="" class="input">
			    <input type="button" value="체크" class="btn-zipcode" onCLick="partnerCheck()" />
			  </td> -->
            </tr>
            <tr>
              <td width="15%" class="t_name">아이디</td>
              <td width="35%" class="t_value">
              	<input name="strID" type="text" value="" class="input" readonly>
              	<input type="button" value="중복체크" class="btn-zipcode" onCLick="idCheck()" />
             	</td>
              <td width="15%" class="t_name">비밀번호</td>
              <td width="35%" class="t_value"><input name="passwd" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">업체명</td>
              <td class="t_value"><input name="com_name" type="text" value="" class="input"></td>
              <td class="t_name">사업자등록번호</td>
              <td class="t_value"><input name="com_num" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">업태</td>
              <td class="t_value"><input name="com_kind" type="text" value="" class="input"></td>
              <td class="t_name">업종</td>
              <td class="t_value"><input name="com_class" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">대표자</td>
              <td class="t_value"><input name="com_owner" type="text" value="" class="input"></td>
              <td class="t_name">담당자</td>
              <td class="t_value"><input name="manager" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">예금주</td>
              <td class="t_value"><input name="acc_name" type="text" value="" class="input"></td>
              <td class="t_name">은행명</td>
              <td class="t_value"><input name="acc_bank" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">계좌번호</td>
              <td class="t_value"><input name="acc_num" type="text" value="" class="input"></td>
              <td class="t_name">홈페이지</td>
              <td class="t_value">http://<input name="homepage" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">이메일</td>
              <td class="t_value"><input name="email" type="text" value="" class="input"></td>
              <td class="t_name">전화번호</td>
              <td class="t_value">
                
                <input type="text" name="com_tel" value="" size="5" class="input"> -
                <input type="text" name="com_tel2" value="" size="5" class="input"> -
                <input type="text" name="com_tel3" value="" size="5" class="input">
              </td>
            </tr>
            <tr>
              <td class="t_name">휴대폰</td>
              <td class="t_value">
                <input type="text" name="com_hp" value=""  size="5" class="input"> -
                <input type="text" name="com_hp2" value=""  size="5" class="input"> -
                <input type="text" name="com_hp3" value=""  size="5" class="input">
              </td>
              <td class="t_name">FAX</td>
              <td class="t_value">
                
                <input type="text" name="com_fax" value=""  size="5" class="input"> -
                <input type="text" name="com_fax2" value=""  size="5" class="input"> -
                <input type="text" name="com_fax3" value=""  size="5" class="input">
              </td>
            </tr>
            <tr>
              <td class="t_name">우편번호</td>
              <td class="t_value" colspan="3">
                <input name="post" type="text" value="" size="5" class="input">
                <input type="button" value="우편번호 검색" onClick="searchZip('');" class="btn-zipcode" />
              </td>
            </tr>
            <tr>
              <td class="t_name">주소</td>
              <td class="t_value" colspan="3">
              <input name="address" type="text" value="" size="60" class="input"><br>
              <input name="address2" type="text" value="" size="60" class="input">
              </td>
            </tr>            
            
            <tr>
              <td height="25" class="t_name">택배사</td>
              <td class="t_value">
				<select name="del_com" id="">
				<?php
				$sql = "select del_trace from wiz_operinfo";
				$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				$admin_oper_info = mysqli_fetch_object($result);

				$del_info = explode("\n", $admin_oper_info->del_trace);
				for($ii = 0; $ii < count($del_info); $ii++) {
					$dellist = explode("^", $del_info[$ii]);
					if(!empty($dellist[0])) {
						echo '<option value="'.$dellist[1]."|".$dellist[2].'">'.$dellist[1].'</option>';
					}
				}
				?>
				</select>	
              </td>
              <td height="25" class="t_name">사진</td>
              <td class="t_value">
                
              	<input name="image" type="file" class="input">
              </td>
            </tr>
            <tr>
              <td height="25" class="t_name">간단소개</td>
              <td class="t_value" colspan="3">
              <textarea name="intro" rows="5" cols="90" class="textarea"></textarea>
              </td>
            </tr>
            
          </table>
        </td>
      </tr>
    </table>
    
    
<div class="AW-btn-wrap">
    <button type="submit" class="on">확인</button>
    <a onClick="document.location='md_login.php?';">취소</a>
</div><!-- .AW-btn-wrap -->

    
    </form>
</body>
</html>
