<? include "../inc/common.inc"; ?>
<? include "../inc/util.inc"; ?>
<?
// 업체등록

	$com_tel 	= $com_tel."-".$com_tel2."-".$com_tel3;
	$com_hp 	= $com_hp."-".$com_hp2."-".$com_hp3;
	$com_fax 	= $com_fax."-".$com_fax2."-".$com_fax3;
	//$post		 	= $post."-".$post2;

	$del_info = explode("|",$del_com);

	// 사진등록
	// if($image['size'] > 0){

	// 	file_check($image['name']);

	// 	$upfile_path = "../../data/md";
	// 	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
	// 	$photo_name = $id.".".substr($image['name'],-3);
	// 	copy($image['tmp_name'], $upfile_path."/".$photo_name);
	// 	chmod($upfile_path."/".$photo_name, 0606);

	// 	$srcimg = $photo_name;
	// 	$dstimg = $photo_name;
	// 	$photo_width = "160";
	// 	img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

	// }

	$created_at = "now()";
	$cms_type = "C";
	$photo_name = isset($photo_name) ? $photo_name : "";
	$comment = isset($comment) ? $comment : "";
	$cms_rate = isset($cms_rate) ? $cms_rate : "0";
	$cms_rate = isset($status) ? $status : "";
	$status = isset($status) ? $status : "";
	$adate = isset($adate) ? $adate : "";
	$last = isset($last) ? $last : "";
	$passwd = password_hash($passwd, PASSWORD_DEFAULT);
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $api_token = '';
    for ($i = 0; $i < 60; $i++) {
        $api_token .= $characters[rand(0, $charactersLength - 1)];
    }
    
	$sql = "select idx from wiz_scraplevel order by level DESC LIMIT 1";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$row = mysqli_fetch_array($result);
	$scraplevel = $row['idx'];
	
	$sql = "select idx from wiz_mdlevel order by level DESC LIMIT 1";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$row = mysqli_fetch_array($result);
	$mdlevel = $row['idx'];
	
	$sql = "select id, strID, md_tree from tb_users where strID = '$prefer'";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$row = mysqli_fetch_array($result);
	$md_tree = "";
	if(count($row)){
		$sentence = $row['md_tree'];
		$removed_first_one = substr($sentence, 1);
		$removed_last_one = substr($removed_first_one, 0, -1);
		$arr3Tree = explode(')(', $removed_last_one);
		//만약 어미로부터 2단계아래 회원이라면
		$cnt = count($arr3Tree);
		if($cnt > 2){
			$md_tree = "(".$arr3Tree[1].")(".$arr3Tree[2].")(".$row['id'].")";
		}else if($cnt == 2){
			$md_tree = "(".$arr3Tree[0].")(".$arr3Tree[1].")(".$row['id'].")";
		}else if($cnt == 1){
			$md_tree = "(".$arr3Tree[0].")(".$row['id'].")";
		}
	}else{
		$md_tree = "(0)";
	}

	$sql = "insert into tb_users (strID,name,password,prefer,md_tree,phone_number,com_name,com_owner,com_num,com_kind,com_class,com_tel,com_hp,com_fax,
					acc_name,acc_bank,acc_num,manager,email,homepage,post,address,address2,image,intro,comment,cms_type,
					cms_rate,del_com,del_trace,status,wdate,adate,last,created_at,updated_at,api_token,bIsUsed)
					values('$strID','$com_name','$passwd','$prefer','$md_tree','$com_hp','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
					'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$homepage','$post','$address',
					'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),'$adate','$last',now(),now(),'$api_token',0)";

	mysqli_query($connect, $sql) or die(mysqli_error($connect));
	//스크레핑 회원등록
	// $sql = "insert into tb_users (name,strID,email,phone_number,image,password,bIsAdmin,role,money,business_name,
	// business_number,business_phone,business_type,business_kind,business_zip,business_address1,business_address2,bIsUsed,api_token,bIsDel)
	// 				values('$id','$passwd','$com_name','$com_owner','$com_num','$com_kind','$com_class','$com_tel','$com_hp',
	// 				'$com_fax','$acc_name','$acc_bank','$acc_num','$manager','$email','$homepage','$post','$address',
	// 				'$address2','$photo_name','$intro','$comment','$cms_type','$cms_rate','$del_info[0]','$del_info[1]','$status',now(),$adate,'$last')";

	// mysqli_query($connect, $sql) or die(mysqli_error($connect));

	complete("회원 가입신청에 성공하였습니다. 관리자의 승인후 이용하실수 있습니다.","md_login.php");



?>