<? include "../../inc/common.inc"; ?>
<? include "../../inc/util.inc"; ?>
<? include "../../inc/shop_info.inc"; ?>
<? include "../../inc/admin_check.inc"; ?>
<? include "../header.php"; ?>
<?
if(!isset($s_status)) $s_status = "";
if(!isset($searchopt)) $searchopt = "";
if(!isset($searchkey)) $searchkey = "";
// 페이지 파라메터 (검색조건이 변하지 않도록)
//------------------------------------------------------------------------------------------------------------------------------------
$param = "s_status=$s_status&searchopt=$searchopt&searchkey=$searchkey";
//------------------------------------------------------------------------------------------------------------------------------------

if($mode == "" || $mode == "insert") {
  $mode = "insert";
  $md_info = new stdClass();
  $md_info->id="";
  $md_info->strID = "";
  $md_info->md_level = "";
  $md_info->sc_level = "";
  $md_info->com_name = "";
  $md_info->com_kind = ""; 
  $md_info->com_owner = "";
  $md_info->manager = "";
  $md_info->com_num = "";
  $md_info->com_class = "";
  $md_info->com_tel = "--";
  $md_info->com_hp = "--";
  $md_info->com_fax = "--";
  $md_info->acc_name = "";
  $md_info->acc_bank = "";
  $md_info->acc_num = "";
  $md_info->homepage = "";
  $md_info->email = "";
  $md_info->post = "";
  $md_info->address = "";
  $md_info->address2 = "";
  $md_info->adate = "";
  $md_info->wdate = "";
  $md_info->status = "";
  $md_info->image = "";
  $md_info->cms_type = "";
  $md_info->cms_rate = "";
  $md_info->del_com = "";
  $md_info->intro = "";
  $md_info->comment = "";
}
if($mode == "update") {
	// 회원정보
	$sql = "select * from tb_users where id = '$id'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$md_info = mysqli_fetch_object($result);
}
?>
<link href="../style.css" rel="stylesheet" type="text/css">
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script language="javascript">
<!--
function inputCheck(frm){
	if(frm.id.value == ""){
	  alert("아이디를 입력하세요");
	  frm.id.focus();
	  return false;
	}
	<? if($mode=="insert"){ ?>
	if(frm.passwd.value == ""){
	  alert("비밀번호를 입력하세요");
	  frm.passwd.focus();
	  return false;
	}
	<? } ?>
	if(frm.com_name.value == ""){
	  alert("업체명을 입력하세요");
	  frm.com_name.focus();
	  return false;
	}
	if(frm.com_num.value == ""){
	  alert("사업자등록번호를 입력하세요");
	  frm.com_num.focus();
	  return false;
	}
	if(frm.status.value == "") {
		alert("승인여부를 선택하세요");
		frm.status.focus();
		return false;
	}
}

// 고객 메일발송
function sendEmail(seluser){
	var url = "../member/send_email.php?seluser=" + seluser;
	window.open(url,"sendEmail","height=700, width=800, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}

// 고객 sms발송
function sendSms(seluser){
	var url = "../member/send_sms.php?seluser=" + seluser;
	window.open(url,"sendSms","height=500, width=450, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, top=100, left=100");
}
/*
// 주소찾기
function searchZip(kind){
	var url = "../member/search_zip.php?kind=" + kind;
	window.open(url,"searchZip","height=350, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
*/
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

// 아이디 중복확인
function idCheck(){
   var id = document.frm.strID.value;
   var url = "../md/id_check.php?name=strID&strID=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}
-->
</script>

	  <table border="0" cellspacing="0" cellpadding="2">
	    <tr>
	      <td><img src="../image/ic_tit.gif"></td>
	      <td valign="bottom" class="tit">MD회원정보</td>
	      <td width="2"></td>
	      <td valign="bottom" class="tit_alt">MD회원정보를 관리합니다.</td>
	    </tr>
	  </table>

	  <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
		  <tr>
		    <td class="tit_sub"><img src="../image/ics_tit.gif"> 기본정보</td>
		  </tr>
		</table>
    <form name="frm" action="md_save.php?<?=$param?>" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
    <input type="hidden" name="tmp">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
            <tr>
              <td width="15%" class="t_name">아이디</td>
              <td width="35%" class="t_value">
              	<input name="strID" type="text" value="<?=$md_info->strID?>" class="input" readonly>
              	<input name="id" type="text" value="<?=$md_info->id?>" class="input" readonly>
              	<? if(strcmp($mode, "update")) { ?>
              	<input type="button" value="중복체크" class="btn-zipcode" onCLick="idCheck()" />
								<? } ?>
             	</td>
              <td width="15%" class="t_name">비밀번호</td>
              <td width="35%" class="t_value"><input name="passwd" type="text" value="" class="input"></td>
            </tr>
            <tr>
              <td width="15%" class="t_name">MD회원등급</td>
              <td width="35%" class="t_value">
                <select name="md_level">
                  <option value="">::선택::
                  <?
                    md_level_list();
                  ?>
                </select>
                <script language="javascript">
                 level = document.frm.md_level;
                 for(ii=0; ii<level.length; ii++){
                    if(level.options[ii].value == "<?=$md_info->md_level?>")
                       level.options[ii].selected = true;
                 }
                </script>
             	</td>
              <td width="15%" class="t_name">스크레핑등급</td>
              <td width="35%" class="t_value">
              <select name="sc_level">
                  <option value="">::선택::
                  <?
                    scrap_level_list();
                  ?>
                </select>
                <script language="javascript">
                 level = document.frm.sc_level;
                 for(ii=0; ii<level.length; ii++){
                    if(level.options[ii].value == "<?=$md_info->sc_level?>")
                       level.options[ii].selected = true;
                 }
                </script>
              </td>
            </tr>
            <tr>
              <td class="t_name">업체명</td>
              <td class="t_value"><input name="com_name" type="text" value="<?=$md_info->com_name?>" class="input"></td>
              <td class="t_name">사업자등록번호</td>
              <td class="t_value"><input name="com_num" type="text" value="<?=$md_info->com_num?>" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">업태</td>
              <td class="t_value"><input name="com_kind" type="text" value="<?=$md_info->com_kind?>" class="input"></td>
              <td class="t_name">업종</td>
              <td class="t_value"><input name="com_class" type="text" value="<?=$md_info->com_class?>" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">대표자</td>
              <td class="t_value"><input name="com_owner" type="text" value="<?=$md_info->com_owner?>" class="input"></td>
              <td class="t_name">담당자</td>
              <td class="t_value"><input name="manager" type="text" value="<?=$md_info->manager?>" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">예금주</td>
              <td class="t_value"><input name="acc_name" type="text" value="<?=$md_info->acc_name?>" class="input"></td>
              <td class="t_name">은행명</td>
              <td class="t_value"><input name="acc_bank" type="text" value="<?=$md_info->acc_bank?>" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">계좌번호</td>
              <td class="t_value"><input name="acc_num" type="text" value="<?=$md_info->acc_num?>" class="input"></td>
              <td class="t_name">홈페이지</td>
              <td class="t_value">http://<input name="homepage" type="text" value="<?=$md_info->homepage?>" class="input"></td>
            </tr>
            <tr>
              <td class="t_name">이메일</td>
              <td class="t_value"><input name="email" type="text" value="<?=$md_info->email?>" class="input"> <input type="button" onClick="sendEmail('<?=$md_info->com_name?>:<?=$md_info->email?>')" value="발송" class="AW-btn-s" /></td>
              <td class="t_name">전화번호</td>
              <td class="t_value">
                <? list($com_tel, $com_tel2, $com_tel3) = explode("-",$md_info->com_tel); ?>
                <input type="text" name="com_tel" value="<?=$com_tel?>" size="5" class="input"> -
                <input type="text" name="com_tel2" value="<?=$com_tel2?>" size="5" class="input"> -
                <input type="text" name="com_tel3" value="<?=$com_tel3?>" size="5" class="input">
              </td>
            </tr>
            <tr>
              <td class="t_name">휴대폰</td>
              <td class="t_value">
                <? list($com_hp, $com_hp2, $com_hp3) = explode("-",$md_info->com_hp); ?>
                <input type="text" name="com_hp" value="<?=$com_hp?>"  size="5" class="input"> -
                <input type="text" name="com_hp2" value="<?=$com_hp2?>"  size="5" class="input"> -
                <input type="text" name="com_hp3" value="<?=$com_hp3?>"  size="5" class="input">
                <? if(!strcmp($shop_info->sms_use, "Y")) { ?>
                <input type="button" onClick="sendSms('<?=$md_info->com_hp?>')" value="발송" class="AW-btn-s" />
              	<? } ?>
              </td>
              <td class="t_name">FAX</td>
              <td class="t_value">
                <? list($com_fax, $com_fax2, $com_fax3) = explode("-",$md_info->com_fax); ?>
                <input type="text" name="com_fax" value="<?=$com_fax?>"  size="5" class="input"> -
                <input type="text" name="com_fax2" value="<?=$com_fax2?>"  size="5" class="input"> -
                <input type="text" name="com_fax3" value="<?=$com_fax3?>"  size="5" class="input">
              </td>
            </tr>
            <tr>
              <td class="t_name">우편번호</td>
              <td class="t_value" colspan="3">
                <input name="post" type="text" value="<?=$md_info->post?>" size="5" class="input">
                <input type="button" value="우편번호 검색" onClick="searchZip('');" class="btn-zipcode" />
              </td>
            </tr>
            <tr>
              <td class="t_name">주소</td>
              <td class="t_value" colspan="3">
              <input name="address" type="text" value="<?=$md_info->address?>" size="60" class="input"><br>
              <input name="address2" type="text" value="<?=$md_info->address2?>" size="60" class="input">
              </td>
            </tr>
            <tr>
              <td class="t_name">신청일</td>
              <td class="t_value"><?=$md_info->wdate?></td>
              <td class="t_name">승인일</td>
              <td class="t_value"><?=$md_info->adate?></td>
            </tr>
            <tr>
              <td class="t_name">승인여부</td>
              <td class="t_value">
                <select name="status">
                <option value="">::선택::
								<option value="Y" <? if($md_info->status == "Y") echo "selected"; ?>>승인</option>
								<option value="N" <? if($md_info->status == "N") echo "selected"; ?>>미승인</option>
                </select>
              </td>
              <td class="t_name">수수료</td>
              <td class="t_value">
              	<input type="radio" name="cms_type" value="C" <? if(!strcmp($md_info->cms_type, "C") || empty($md_info->cms_type)) echo "checked" ?>> 카테고리별 수수료
              	<input type="radio" name="cms_type" value="M" <? if(!strcmp($md_info->cms_type, "M")) echo "checked" ?>> MD회원별 수수료
              	(<input type="text" name="cms_rate" value="<?=$md_info->cms_rate?>" class="input" size="2">%)
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
					?>
						<option <? if($md_info->del_com == $dellist[1]) echo "selected" ?> value="<?=$dellist[1]?>|<?=$dellist[2]?>"><?=$dellist[1]?></option>
					<?php
					}
				}
				?>
				</select>	
              </td>
              <td height="25" class="t_name">사진</td>
              <td class="t_value">
                <?
              	if($md_info->image != "" && file_exists("../../data/md/".$md_info->image)){
              		echo "<img src=/data/md/".$md_info->image.">";
              		echo "<input type='checkbox' name='delphoto' value='Y'>";
              		echo "<font color='red'>삭제</font> <br>";
              	}
              	?>
              	<input name="image" type="file" class="input">
              </td>
            </tr>
            <tr>
              <td height="25" class="t_name">간단소개</td>
              <td class="t_value" colspan="3">
              <textarea name="intro" rows="5" cols="90" class="textarea"><?=$md_info->intro?></textarea>
              </td>
            </tr>
            <tr>
              <td height="25" class="t_name">관라자주석</td>
              <td class="t_value" colspan="3">
              <textarea name="comment" rows="5" cols="90" class="textarea"><?=$md_info->comment?></textarea>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    
    
<div class="AW-btn-wrap">
    <button type="submit" class="on">확인</button>
    <a onClick="document.location='md_list.php?<?=$param?>';">목록</a>
</div><!-- .AW-btn-wrap -->

    
    </form>

<? include "../footer.php"; ?>