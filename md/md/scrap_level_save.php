<? include "../../inc/common.inc"; ?>
<? include "../../inc/md_check.inc"; ?>

<?
if($mode == "insert"){

  $sql = "insert into wiz_scraplevel(idx,level,icon,name,distype,discount,exp) values('','$level','$icon','$name','$distype','$discount','$exp')";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("등록되었습니다.","md_scrap_level.php");
	
}else if($mode == "update"){
	
	for($ii=0; $ii<count($permi); $ii++){
      $tmp_permi .= $permi[$ii]."/";
   }
   
	$sql = "update wiz_scraplevel set level='$level', icon='$icon', name='$name', distype='$distype', discount='$discount', exp='$exp' where idx = '$idx'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	complete("수정되었습니다","level_input.php?mode=update&idx=$idx");
	
}else if($mode == "delete"){
	
	$sql = "select idx from wiz_mdlevel where level > $level order by idx asc limit 1";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$row = mysqli_fetch_object($result);
	$chg_level = $row->idx;
	
	$sql = "update tb_users set level = '$chg_level' where level = '$idx'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	// $sql = "update wiz_bbsinfo set lpermi = '$chg_level' where lpermi = '$idx'";
	// $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	// $sql = "update wiz_bbsinfo set rpermi = '$chg_level' where rpermi = '$idx'";
	// $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	// $sql = "update wiz_bbsinfo set wpermi = '$chg_level' where wpermi = '$idx'";
	// $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	// $sql = "update wiz_bbsinfo set apermi = '$chg_level' where apermi = '$idx'";
	// $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	// $sql = "update wiz_bbsinfo set cpermi = '$chg_level' where cpermi = '$idx'";
	// $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	$sql = "delete from wiz_scraplevel where idx = '$idx'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	complete("삭제되었습니다.","md_level.php");
	
}

?>