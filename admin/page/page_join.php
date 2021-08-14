<? include "../../inc/common.inc"; ?>
<? include "../../inc/shop_info.inc"; ?>
<? include "../../inc/admin_check.inc"; ?>
<? include "../header.php"; ?>
<?
$type = "join";
$sql = "select * from wiz_page where type='$type'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$page_info = mysqli_fetch_object($result);
if(!get_magic_quotes_gpc()) $page_info->content = stripslashes($page_info->content);
if(!get_magic_quotes_gpc()) $page_info->content2 = stripslashes($page_info->content2);

// 입력정보 사용여부
$info_tmp = explode("/",$page_info->addinfo);
for($ii=0; $ii<count($info_tmp); $ii++){
	$info_use[$info_tmp[$ii]] = true;
}

// 입력정보 필수여부
$info_tmp = explode("/",$page_info->addinfo2);
for($ii=0; $ii<count($info_tmp); $ii++){
	$info_ess[$info_tmp[$ii]] = true;
}

?>

<script language="javascript">
<!--
function setEss(frm, val) {

	for(ii = 0; ii < frm.elements["info_use[]"].length; ii++) {
		if(frm.elements["info_use[]"][ii].value == val) {
			frm.elements["info_ess[]"][ii].checked = frm.elements["info_use[]"][ii].checked;
			break;
		}
	}

}
-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
			  <tr>
			    <td><img src="../image/ic_tit.gif"></td>
			    <td valign="bottom" class="tit">회원가입</td>
			    <td width="2"></td>
			    <td valign="bottom" class="tit_alt">회원가입 페이지를 설정합니다.</td>
			  </tr>
			</table>

      <br>
      <form name="frm" action="page_save.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="update">
      <input type="hidden" name="type" value="<?=$type?>">
      <input type="hidden" name="page" value="page_join.php">
      <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
		<!--
        <tr>
         <td width="15%" class="t_name">상단이미지</td>
         <td width="85%" class="t_value">
          <?
          if($page_info->subimg != "") echo "<img src='/data/subimg/$page_info->subimg' width='500'> <a href='page_save.php?mode=delimg&type=$type&subimg=$page_info->subimg'><font color='red'>[삭제]</font></a><br>";
          ?>
         <input type="file" name="subimg" class="input">
         </td>
        </tr>
		-->
        <tr>
         <td width="15%" class="t_name">입력정보</td>
         <td class="t_value" align="center">
           <table width="98%" border="0" cellspacing="1" cellpadding="0">
             <tr><td height="5"></td></tr>
             <tr>
               <td  class="t_name" width="100">아이디</td>
               <td width="180">사용함</td>
               <td  class="t_name" width="100">비밀번호</td>
               <td width="180">사용함</td>
             </tr>
             <tr>
               <td  class="t_name" height="25">이름</td>
               <td>사용함</td>
               <td  class="t_name">주민번호</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="resno" <? if($info_use["resno"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="resno" <? if($info_ess["resno"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25">이메일</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="email" <? if($info_use["email"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="email" <? if($info_ess["email"]==true) echo "checked";?>>필수항목
               </td>
               <td  class="t_name">주소</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="address" <? if($info_use["address"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="address" <? if($info_ess["address"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25">전화번호</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="tphone" <? if($info_use["tphone"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="tphone" <? if($info_ess["tphone"]==true) echo "checked";?>>필수항목
               </td>
               <td  class="t_name">휴대폰</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="hphone" <? if($info_use["hphone"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="hphone" <? if($info_ess["hphone"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25">FAX</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="fax" <? if($info_use["fax"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="fax" <? if($info_ess["fax"]==true) echo "checked";?>>필수항목
               </td>
               <td  class="t_name">기업정보</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="company" <? if($info_use["company"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="company" <? if($info_ess["company"]==true) echo "checked";?>>필수항목
               </td>
              </tr>
             <tr><td colspan="4" height="2"></td></tr>
             <tr>
               <td  class="t_name" height="25">생년월일</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="birthday" <? if($info_use["birthday"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="birthday" <? if($info_ess["birthday"]==true) echo "checked";?>>필수항목
               </td>
               <td  class="t_name">관심분야</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="consph" <? if($info_use["consph"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="consph" <? if($info_ess["consph"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25">결혼여부</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="marriage" <? if($info_use["marriage"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="marriage" <? if($info_ess["marriage"]==true) echo "checked";?>>필수항목
               </td>
               <td  class="t_name">결혼기념일</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="memorial" <? if($info_use["memorial"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="memorial" <? if($info_ess["memorial"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25">직업</td>
               <td>
                 <input type="checkbox" name="info_use[]" value="job" <? if($info_use["job"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="job" <? if($info_ess["job"]==true) echo "checked";?>>필수항목</td>
               <td  class="t_name">학력
               </td>
               <td>
                 <input type="checkbox" name="info_use[]" value="scholarship" <? if($info_use["scholarship"]==true) echo "checked";?>>사용함
                 <input type="checkbox" name="info_ess[]" value="scholarship" <? if($info_ess["scholarship"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr>
               <td  class="t_name" height="25"><b>스팸글체크</b></td>
               <td>
	               <input type="checkbox" name="info_use[]" value="spam" <? if($info_use["spam"]==true) echo "checked";?> onClick="setEss(this.form, this.value)">사용함
	               <input type="checkbox" name="info_ess[]" value="spam" <? if($info_ess["spam"]==true) echo "checked";?>>필수항목
               </td>
             </tr>
             <tr><td height="5"></td></tr>
           </table>
         </td>
        </tr>
        <tr>
        	<td class="t_name">이용약관</td>
          <td class="t_value"><textarea name="content" rows="15" cols="60" style="width:100%" class="textarea"><?=$page_info->content?></textarea></td>
        </tr>
        <tr>
        	<td class="t_name">개인정보 보호정책</td>
          <td class="t_value"><textarea name="content2" rows="15" cols="60" style="width:100%" class="textarea"><?=$page_info->content2?></textarea></td>
        </tr>
      </table>


        <div class="AW-btn-wrap">
            <button type="submit" class="on">확인</button>
            <a onClick="history.go(-1);">취소</a>
        </div><!-- .AW-btn-wrap -->


    </td>
  </tr>
</table>

</form>
<? include "../footer.php"; ?>