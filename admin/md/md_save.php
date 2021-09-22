<? include "../../inc/common.inc"; ?>
<? include "../../inc/util.inc"; ?>
<? include "../../inc/admin_check.inc"; ?>
<?
// 페이지 파라메터 (검색조건이 변하지 않도록)
//------------------------------------------------------------------------------------------------------------------------------------
$param = "s_status=$s_status&searchopt=$searchopt&searchkey=$searchkey";
//------------------------------------------------------------------------------------------------------------------------------------

// 업체등록
if($mode == "insert"){

	$com_tel 	= $com_tel."-".$com_tel2."-".$com_tel3;
	$com_hp 	= $com_hp."-".$com_hp2."-".$com_hp3;
	$com_fax 	= $com_fax."-".$com_fax2."-".$com_fax3;
	//$post		 	= $post."-".$post2;

	$del_info = explode("|",$del_com);

	// 사진등록
	if($photo['size'] > 0){

		file_check($photo['name']);

		$upfile_path = "../../data/md";
		if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
		$photo_name = $id.".".substr($photo['name'],-3);
		copy($photo['tmp_name'], $upfile_path."/".$photo_name);
		chmod($upfile_path."/".$photo_name, 0606);

		$srcimg = $photo_name;
		$dstimg = $photo_name;
		$photo_width = "160";
		img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

	}

	if(!strcmp($status, "Y")) $adate = "now()"; else $adate = "''";

	$passwd = password_hash($passwd, PASSWORD_DEFAULT);

	$sql = "insert into tb_users (name,strID,password,com_name,com_owner,com_num,com_kind,com_class,com_tel,com_hp,com_fax,
					acc_name,acc_bank,acc_num,manager,email,md_level,sc_level,homepage,post,address,address2,image,intro,comment,cms_type,
					cms_rate,del_com,del_trace,status,wdate,adate,last)
					values('$com_name','$strID','$passwd','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
					'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$md_level','$sc_level','$homepage','$post','$address',
					'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),$adate,'$last')";

	mysqli_query($connect, $sql) or die(mysqli_error($connect));
	//스크레핑 회원등록
	// $sql = "insert into tb_users (name,strID,email,phone_number,image,password,bIsAdmin,role,money,business_name,
	// business_number,business_phone,business_type,business_kind,business_zip,business_address1,business_address2,bIsUsed,api_token,bIsDel)
	// 				values('$id','$passwd','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
	// 				'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$homepage','$post','$address',
	// 				'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),$adate,'$last')";

	// mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("업체를 등록하였습니다.","md_list.php?$param");

// 업체정보 수정
}else if($mode == "update"){

	$com_tel 	= $com_tel."-".$com_tel2."-".$com_tel3;
	$com_hp 	= $com_hp."-".$com_hp2."-".$com_hp3;
	$com_fax 	= $com_fax."-".$com_fax2."-".$com_fax3;
	//$post		 	= $post."-".$post2;

	$del_info = explode("|",$del_com);


	if(!strcmp($delphoto, "Y")) {

		$sql = "select photo from tb_users where id = '$id'";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$row = mysqli_fetch_array($result);

	 	$upfile_path = "../../data/mall";
	 	@unlink($upfile_path."/".$row['photo']);

	}

	// 사진등록
	if($photo['size'] > 0){

		file_check($photo['name']);

		$upfile_path = "../../data/md";
		if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
		$photo_name = $id.".".substr($photo['name'],-3);
		@unlink($upfile_path."/".$id.".gif");
		@unlink($upfile_path."/".$id.".jpg");
		copy($photo['tmp_name'], $upfile_path."/".$photo_name);
		chmod($upfile_path."/".$photo_name, 0606);

		$srcimg = $photo_name;
		$dstimg = $photo_name;
		$photo_width = "160";
		img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

		$photo_sql = " image = '$photo_name', ";

	}

	if(!strcmp($status, "Y") && strcmp($status, $tmp_status)){
		$adate_sql = " , adate = now() ";

	} 
	$bIsUsed = 0;
	if(!strcmp($status, "Y")){
		$bIsUsed = 1;
	}else{
		$bIsUsed = 0;
	}

	if($passwd != "") {
		$passwd = password_hash($passwd,PASSWORD_DEFAULT);
		$passwd_sql = " password = '$passwd', ";
	}

	$sql = "update tb_users set $passwd_sql com_name='$com_name',sc_level='$sc_level',md_level='$md_level',com_owner='$com_owner',com_num='$com_num',com_kind='$com_kind',
					com_class='$com_class',com_tel='$com_tel',com_hp='$com_hp',com_fax='$com_fax',acc_name='$acc_name',
					acc_bank='$acc_bank',acc_num='$acc_num',manager='$manager',email='$email',homepage='$homepage',
					post='$post',address='$address',address2='$address2', $photo_sql intro='$intro', comment='$comment',
					cms_type='$cms_type',cms_rate='$cms_rate',del_com='$del_info[0]',del_trace='$del_info[1]', bIsUsed=$bIsUsed, status='$status' $adate_sql
					where id = '$id'";

	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("업체정보를 수정하였습니다.","md_info.php?mode=$mode&id=$id&$param");

// 업체 삭제
}else if($mode == "deluser"){

	$upfile_path = "../../data/mall";
	$array_seluser = explode("|",$seluser);
	$i=0;
	while($array_seluser[$i]){

		$md_id = $array_seluser[$i];

		// 입점업체 상품 삭제
    $sql = "select prdcode from wiz_product where md_id = '$md_id'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($result)) {

    	$prdcode = $row['prdcode'];

			// 카테고리 연관 삭제
			$sql = "delete from wiz_cprelation where prdcode = '$prdcode'";
			mysqli_query($connect, $sql) or die(mysqli_error($connect));

			// 관련련상품 연관 삭제
			$sql = "delete from wiz_prdrelation where prdcode = '$prdcode' || relcode = '$prdcode'";
			mysqli_query($connect, $sql) or die(mysqli_error($connect));

			// 상품데이타 삭제
			foreach (glob($prdimg_path."/".$prdcode."*") as $filename) {
	   			@unlink($filename);
			}

			// 상품평 삭제
			$sql = "delete from wiz_comment where prdcode = '$prdcode'";
			mysqli_query($connect, $sql) or die(mysqli_error($connect));

			$sql = "delete from wiz_product where prdcode = '$prdcode'";
			mysqli_query($connect, $sql) or die(mysqli_error($connect));

    }

		@unlink($upfile_path."/".$md_id.".gif");
		@unlink($upfile_path."/".$md_id.".jpg");

		// 입점업체 테이블에서 삭제
		$sql = "delete from tb_users where id = '$md_id'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

		$i++;
	}

	complete("업체를 삭제하였습니다.","mall_list.php?$param");

// 업체탈퇴 삭제
}else if($mode == "malloutdel"){

	$sql = "delete from wiz_bbs where idx = '$idx'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("탈퇴내역을 삭제하였습니다.","");

// 승인상태 변경
} else if(!strcmp($mode, "chgstatus")) {

	if(!strcmp($chg_status, "Y") && strcmp($status, $chg_status)) $adate_sql = ", adate = now() ";
	if(!strcmp($chg_status, "Y")){
		$bIseUsed = 1;
	}else{
		$bIseUsed = 0;
	}

	$sql = "update tb_users set bIsUsed = $bIseUsed, status = '$chg_status' $adate_sql where id = '$id'";
	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("승인상태를 변경하였습니다.","");

// 상태 일괄변경
}else if($mode == "batchStatus"){

	$i=0;
	$array_selvalue = explode("|",$selvalue);
	while($array_selvalue[$i]){
		list($id, $old_status) = explode(":",$array_selvalue[$i]);

		if(!strcmp($chg_status, "Y") && strcmp($old_status, $chg_status)) $adate_sql = ", adate = now() ";
		if(!strcmp($chg_status, "Y")){
			$bIseUsed = 1;
		}else{
			$bIseUsed = 0;
		}

		$sql = "update wiz_mall set bIsUsed = $bIseUsed, status = '$chg_status' $adate_sql where id = '$id'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

		$i++;
	}

	echo "<script>alert('상태를 변경하였습니다.');opener.document.location.reload();self.close();</script>";

// 입점업체 탈퇴 승인
} else if(!strcmp($mode, "mallout")) {

	// 입점업체 상품 삭제
	$sql = "select prdcode from wiz_product where mallid = '$mallid'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	while($row = mysqli_fetch_array($result)) {

		// 카테고리 연관 삭제
		$sql = "delete from wiz_cprelation where prdcode = '".$row['prdcode']."'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

		// 관련련상품 연관 삭제
		$sql = "delete from wiz_prdrelation where prdcode = '".$row['prdcode']."' || relcode = '".$row['prdcode']."'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

		// 상품데이타 삭제
		foreach (glob($prdimg_path."/".$row['prdcode']."*") as $filename) {
   		@unlink($filename);
		}

		// 상품평 삭제
		$sql = "delete from wiz_comment where prdcode = '".$row['prdcode']."'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

		$sql = "delete from wiz_product where prdcode = '".$row['prdcode']."'";
		mysqli_query($connect, $sql) or die(mysqli_error($connect));

	}

	$upfile_path = "../../data/md";

	@unlink($upfile_path."/".$mdid.".gif");
	@unlink($upfile_path."/".$mdid.".jpg");

	// 입접업체 삭제
	$sql = "delete from tb_users where id = '$mdid'";
	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	// 탈퇴신청 내용 삭제(입점업체 아이디를 [out] 으로 처리)
	$sql = "update wiz_bbs set memid = '".$mdid."[out]', addinfo1 = now() where code = 'mallout' and memid = '$mdid'";
	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	// 주문내역 삭제(입점업체 아이디를 [out] 으로 처리)
	$sql = "update wiz_basket set mallid = '".$mdid."[out]' where  mallid = '$mdid'";
	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	// 정산내역 삭제(입접업체 아이디를 [out] 으로 처리)
	//$sql = "update wiz_account set mallid = '".$mallid."[out]' where mallid = '$mallid'";
	//mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("업체를 삭제하였습니다.","mall_out.php");

}

?>