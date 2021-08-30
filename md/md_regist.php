<? include "../../inc/common.inc"; ?>
<? include "../../inc/util.inc"; ?>
<?
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

	$created_at = "now()";

	$passwd = password_hash($passwd, PASSWORD_DEFAULT);

	$sql = "insert into tb_users (id,strID,password,prefer, com_name,com_owner,com_num,com_kind,com_class,com_tel,com_hp,com_fax,
					acc_name,acc_bank,acc_num,manager,email,homepage,post,address,address2,photo,intro,comment,cms_type,
					cms_rate,del_com,del_trace,status,wdate,adate,last,created_at, api_token, bIsUsed, )
					values('$strID','$passwd','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
					'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$homepage','$post','$address',
					'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),$adate,'$last')";

	mysqli_query($connect, $sql) or die(mysqli_error($connect));
	//스크레핑 회원등록
	// $sql = "insert into tb_users (name,strID,email,phone_number,image,password,bIsAdmin,role,money,business_name,
	// business_number,business_phone,business_type,business_kind,business_zip,business_address1,business_address2,bIsUsed,api_token,bIsDel)
	// 				values('$id','$passwd','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
	// 				'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$homepage','$post','$address',
	// 				'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),$adate,'$last')";

	// mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("회원 가입신청에 성공하였습니다. 관리자의 승인후 이용하실수 있습니다.","md_login.php");

}

?>