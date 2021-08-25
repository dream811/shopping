<? include "../../inc/common.inc"; ?>
<? include "../../inc/shop_info.inc"; ?>
<? include "../../inc/admin_check.inc"; ?>
<? include "../header.php"; ?>

<?
// 전체관리자 인경우만 권한설정 가능
if(isset($wiz_admin['level_value']) && $wiz_admin['level_value'] != 0) error("권한이 없습니다.");

if($mode == "update"){
	$sql = "select * from wiz_scraplevel where idx = '$idx'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$row = mysqli_fetch_object($result);
}
if($mode == "") $mode = "insert";
if($row->buyFeeAmt == "") $row->buyFeeAmt = "0";
if($row->delFeeType == "") $row->delFeeType = "0";
?>
<script language="JavaScript" src="/js/util_lib.js"></script>
<script language="javascript">
<!--
function inputCheck(frm){
	if(frm.name.value == ""){
		alert("등급명을 입력하세요.");
		frm.name.focus();
		return false;
	}
}

//-->
</script>

      
      <table border="0" cellspacing="0" cellpadding="2">
		    <tr>
		      <td><img src="../image/ic_tit.gif"></td>
		      <td valign="bottom" class="tit">등급관리</td>
		      <td width="2"></td>
		      <td valign="bottom" class="tit_alt">스크레핑회원등급을 설정합니다.</td>
		    </tr>
		  </table>
		  
	  	<br>	
      <form name="frm" action="scrap_level_save.php" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr> 
                <td width="15%" class="t_name">등급명</td>
                <td width="85%" class="t_value"><input type="text" size="30" name="name" value="<?=$row->name?>" class="input"></td>
              </tr>
              <tr> 
                <td class="t_name">등급레벨</td>
                <td class="t_value">
                <?
                if($mode == "insert" || $row->level > 0){
                ?>
                  <select name="level">
                  <option value="1" <? if($row->level == "1") echo "selected"; ?>>1
                  <option value="2" <? if($row->level == "2") echo "selected"; ?>>2
                  <option value="3" <? if($row->level == "3") echo "selected"; ?>>3
                  <option value="4" <? if($row->level == "4") echo "selected"; ?>>4
                  <option value="5" <? if($row->level == "5") echo "selected"; ?>>5
                  <option value="6" <? if($row->level == "6") echo "selected"; ?>>6
                  <option value="7" <? if($row->level == "7") echo "selected"; ?>>7
                  <option value="8" <? if($row->level == "8") echo "selected"; ?>>8
                  <option value="9" <? if($row->level == "9") echo "selected"; ?>>9
                  <option value="10" <? if($row->level == "10") echo "selected"; ?>>10
                  </select>
                <?
                }else{
                ?>
                <input type="hidden" name="level" value="<?=$row->level?>">
                <?=$row->level?>
                <?
                }
                ?>
                </td>
              </tr>
              <tr> 
                <td class="t_name">구매할인타입</td>
                <td class="t_value">
                  <input type="radio" name="buyFeeType" value="W" <? if($row->buyFeeType == 0 || $row->buyFeeType == "" || $row->buyFeeType == "W") echo "checked"; ?>>원 (구매시 x원 할인 혜택을 드립니다.)<br>
                  <input type="radio" name="buyFeeType" value="P" <? if($row->buyFeeType == "P") echo "checked"; ?>> 퍼센트 (구매액의 x%할인혜택을드립니다.)
                </td>
              </tr>
              <tr> 
                <td class="t_name">구매할인액</td>
                <td class="t_value"><input type="text" name="buyFeeAmt" value="<?=$row->buyFeeAmt?>" class="input"> 원 또는 %</td>
              </tr>
              <tr> 
                <td class="t_name">배송할인타입</td>
                <td class="t_value">
                  <input type="radio" name="delFeeType" value="W" <? if($row->delFeeType == 0 || $row->delFeeType == "" || $row->delFeeType == "W") echo "checked"; ?>>원 (구매시 x원 할인 혜택을 드립니다.)<br>
                  <input type="radio" name="delFeeType" value="P" <? if($row->delFeeType == "P") echo "checked"; ?>> 퍼센트 (구매액의 x%할인혜택을드립니다.)
                </td>
              </tr>
              <tr> 
                <td class="t_name">배송할인액</td>
                <td class="t_value"><input type="text" name="delFeeAmt" value="<?=$row->delFeeAmt?>" class="input"> 원 또는 %</td>
              </tr>
              <!--tr> 
                <td class="t_name">접근권한</td>
                <td class="t_value">
                  <?
                  $permi_list = explode("/",$row->permi);
                  for($ii=0; $ii<count($permi_list); $ii++){
                     $tmp_permi[$permi_list[$ii]] = true;
                  }
                  ?>
                  <input type="checkbox" size="20" name="permi[]" value="00" <? if($tmp_permi["00"]==true) echo "checked"; ?>>관리자(인트라넷)접근
                  <input type="checkbox" size="20" name="permi[]" value="01" <? if($tmp_permi["01"]==true) echo "checked"; ?>>환경설정
                  <input type="checkbox" size="20" name="permi[]" value="02" <? if($tmp_permi["02"]==true) echo "checked"; ?>>기본정보
                  <input type="checkbox" size="20" name="permi[]" value="03" <? if($tmp_permi["03"]==true) echo "checked"; ?>>사내업무>
                  <input type="checkbox" size="20" name="permi[]" value="04" <? if($tmp_permi["04"]==true) echo "checked"; ?>>회원관리
                  <input type="checkbox" size="20" name="permi[]" value="05" <? if($tmp_permi["05"]==true) echo "checked"; ?>>게시판관리
                  <input type="checkbox" size="20" name="permi[]" value="06" <? if($tmp_permi["06"]==true) echo "checked"; ?>>마케팅분석
                </td>
              </tr-->
              <tr> 
                <td class="t_name">설명</td>
                <td class="t_value"><textarea name="exp" rows="6" cols="60" class="textarea"><?=$row->exp?></textarea></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
      
      <div class="AW-btn-wrap">
        <button type="submit" class="on">확인</button>
        <a onClick="document.location='md_scrap_level.php';">목록</a>
    </div><!-- .AW-btn-wrap -->
      </form>

<? include "../footer.php"; ?>