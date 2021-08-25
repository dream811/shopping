<ul class="lnb">
	<? if(strpos($wiz_admin['permi'], "13-01") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_list") !== false){ echo 'active'; } ?>"><a href="md_list.php">MD회원목록</a></li>
    <? } ?>
    
    <? if(strpos($wiz_admin['permi'], "13-02") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_level") !== false){ echo 'active'; } ?>"><a href="md_level.php">등급관리</a></li>
    <? } ?>
    
    <? /* if(strpos($wiz_admin['permi'], "13-03") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_qna") !== false){ echo 'active'; } ?>"><a href="md_qna.php">1:1 상담관리</a></li>
    <? } ?>
    
    <? if(strpos($wiz_admin['permi'], "13-04") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_out") !== false){ echo 'active'; } ?>"><a href="md_out.php">탈퇴회원</a></li>
    <? } ?>
    
    <? if(strpos($wiz_admin['permi'], "13-05") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_email") !== false){ echo 'active'; } ?>"><a href="md_email.php">메일발송</a></li>
    <? } ?>
    
    <? if((strpos($wiz_admin['permi'], "13-06") !== false || !strcmp($wiz_admin['designer'], "Y")) && !strcmp($shop_info->sms_use, "Y")) { ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_sms") !== false){ echo 'active'; } ?>"><a href="md_sms.php">SMS발송</a></li>
    <? } */ ?>
    
    <? if(strpos($wiz_admin['permi'], "13-07") !== false || !strcmp($wiz_admin['designer'], "Y")){ ?>
    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_scrap_level") !== false){ echo 'active'; } ?>"><a href="md_scrap_level.php">스크레핑등급관리</a></li>
    <? } ?>

    <li class="<?php if(strpos($_SERVER['PHP_SELF'],"/md_analy") !== false){ echo 'active'; } ?>"><a href="md_analy.php">회원통계</a></li>
</ul>