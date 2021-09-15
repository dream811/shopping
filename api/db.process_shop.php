<?php


//로그인 (없는 경우 가입 진행)
function userLogin($userId, $prdcode="")
{
	global $connect;
	global $_http_host;
	$http_port = $_SERVER['SERVER_PORT'] == "" ? "": ":".$_SERVER['SERVER_PORT'];

	$sql = "select id,passwd,name,email,tphone,hphone,level from wiz_member where id='$userId'";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	$wiz_session = array();
	// 일반회원 로그인
	if($row = mysqli_fetch_object($result)){

		//방문회수 증가
		$sql = "update wiz_member set visit = visit+1 , visit_time = now() where id='$userId'";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		global $wiz_session;
		$level_info = level_info();
		$level_value = $level_info[$row->level]['level'];

		$wiz_session['id'] = $_SESSION['wiz_session']['id']			= $row->id;
		$wiz_session['passwd'] = $_SESSION['wiz_session']['passwd']		= $row->passwd;
		$wiz_session['name'] = $_SESSION['wiz_session']['name']		= $row->name;
		$wiz_session['tphone'] = $_SESSION['wiz_session']['tphone']		= $row->tphone;
		$wiz_session['hphone'] = $_SESSION['wiz_session']['hphone']		= $row->hphone;
		$wiz_session['email'] = $_SESSION['wiz_session']['email']		= $row->email;
		$wiz_session['level'] = $_SESSION['wiz_session']['level']		= $row->level;
		$wiz_session['level_value'] = $_SESSION['wiz_session']['level_value']	= $level_value;
		$prev="";
		if(empty($prdcode)) $prev = "http://".$_http_host.$http_port;
		else $prev = "http://".$_http_host.$http_port."/shop/prd_view.php?prdcode=".$prdcode;
		Header("Location: $prev");

	// 관리자 로그인
	}else{
		// 가입레벨(가장낮은 레벨)
		$sql = "select idx from wiz_level order by level desc limit 1";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$row = mysqli_fetch_object($result);
		$level = $row->idx;

		$passwd = md5($userId);

		// 입력정보 저장
		$sql = "insert into wiz_member(id,passwd,name,resno,email,tphone,hphone,fax,post,address,address2,reemail,resms,birthday,bgubun,marriage,memorial,
											scholarship,job,income,car,consph,conprd,level,recom,visit,visit_time,comment,com_num,com_name,com_owner,com_post,com_address,com_kind,com_class,wdate)
											values('$userId', '$passwd', '$userId', '', '${userId}@mail.com', '000-000-0000', '000-000-0000', '000-000-0000', '', '', '', '', '',
											'', '', '', '', '', '', '', '', '', '',
											'$level', '', '', '', '','','','','','','','', now())";

		mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$prev="";
		if(empty($prdcode)) $prev = "http://".$_http_host.$http_port;
		else $prev = "http://".$_http_host.$http_port."/shop/prd_view.php?prdcode=".$prdcode;
		Header("Location: $prev");
	}
    
}

//상품리스트자료
function getProducts($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 상품넘버 만들기
	$sql = "select wiz_product.prdcode, prdname, prdcom, origin, stock, sellprice, conprice, supprice, reserve, new, best, popular, recom, sale, mallid, prdimg_R as main_image, prdimg_L1 as large_image, prdimg_M1 as medium_image, prdimg_S1 as small_image, wiz_category.catcode as category_code, wiz_category.catname as category_name from wiz_product left join wiz_cprelation on wiz_product.prdcode = wiz_cprelation.prdcode left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode where status='Y' limit $pageSize offset $lastIndex";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
			$row['main_image'] = $row['main_image'] != "" ? "http://xn--9n3bo0el5b.com/data/prdimg/".$row['main_image'] : "";
			$row['large_image'] = $row['large_image'] != "" ? "http://xn--9n3bo0el5b.com/data/prdimg/".$row['large_image'] : "";
			$row['medium_image'] = $row['medium_image'] != "" ? "http://xn--9n3bo0el5b.com/data/prdimg/".$row['medium_image'] : "";
			$row['small_image'] = $row['small_image'] != "" ? "http://xn--9n3bo0el5b.com/data/prdimg/".$row['small_image'] : "";
            array_push($rows, $row);
        }
    }
	return $rows;
}
//상품코드리스트 자료
function getProductCodes($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 상품넘버 만들기
	$sql = "select prdcode from wiz_product where status='Y' limit $pageSize offset $lastIndex";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
            array_push($rows, $row);
        }
    }
	return $rows;
}
//상품상세 자료
function getProductInfo($prdcode)
{
    global $connect;
    // 상품넘버 만들기
	//$sql = "select wiz_product.prdcode, prdname, prdcom, origin, stock, sellprice, conprice, supprice, reserve, new, best, popular, recom, sale, mallid, prdimg_R as main_image, prdimg_L1 as large_image, prdimg_M1 as medium_image, prdimg_S1 as small_image, wiz_category.catcode as category_code, wiz_category.catname as category_name from wiz_product left join wiz_cprelation on wiz_product.prdcode = wiz_cprelation.prdcode left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode where status='Y' and wiz_product.prdcode=$prdcode";
	$sql = "select wiz_product.prdcode, prdname, prdcom, origin, stock, sellprice, prdimg_R as main_image, wiz_category.catcode as category_code, wiz_category.catname as category_name from wiz_product left join wiz_cprelation on wiz_product.prdcode = wiz_cprelation.prdcode left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode where status='Y' and wiz_product.prdcode=$prdcode";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	if($row = mysqli_fetch_assoc($result)){
		$row['main_image'] = $row['main_image'] != "" ? "http://xn--9n3bo0el5b.com/data/prdimg/".$row['main_image'] : "";
		$row['nProfit'] = number_format($row['sellprice'] * 0.15, 0, '.', '');
	}
	return $row;
}
//주문자료
function getOrders($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 주문자료 만들기
	$sql = "select wiz_order.orderid, send_id, send_name, send_tphone, send_hphone, send_email, send_post, send_address, rece_name, rece_tphone, rece_hphone, rece_address, pay_method, reserve_price, deliver_method, deliver_price, wiz_order.deliver_date, prd_price, total_price, order_date, pay_date, send_date, 
	wiz_basket.prdcode as prdcode, wiz_basket.prdname as prdname, wiz_basket.mallid as mallid, wiz_basket.amount as stock, wiz_category.catcode as catcode 
	
	from wiz_order
	left join wiz_basket
	on wiz_order.orderid = wiz_basket.orderid
	left join wiz_cprelation on wiz_basket.prdcode = wiz_cprelation.prdcode 
	left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode
	limit $pageSize offset $lastIndex";

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
			$row['profit_price'] = number_format($row['total_price'] * 0.3, 0, '.', '');
            array_push($rows, $row);
        }
    }
	return $rows;
}
// 카테고리
function getCategories($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 카테고리 만들기
	$sql = "select catcode, catname, cms_rate from wiz_category limit $pageSize offset $lastIndex";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
            array_push($rows, $row);
        }
    }
	return $rows;
}

//주문자료
function getSellData($sell_date = "", $shop_agent = "")
{
	$sql_agent = "";

	if($shop_agent != ""){
		$sql_agent = "and wiz_basket.mallid = '$shop_agent'";
	}
    global $connect;
    // 주문자료 만들기
	$sql = "select  
	order_date as strTime, total_price,
	wiz_basket.prdcode as strProductID, wiz_basket.prdname as strProductName, wiz_basket.mallid as mallid, wiz_basket.amount as nProductCnt, 
	IFNULL(wiz_cprelation.catcode, '00000000') as strCategoryID, IFNULL(wiz_category.catname, '') as strCategoryName 
	
	from wiz_order
	left join wiz_basket on wiz_order.orderid = wiz_basket.orderid
	left join wiz_cprelation on wiz_basket.prdcode = wiz_cprelation.prdcode
	left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode
	where order_date > '$sell_date' $sql_agent order by order_date";

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
			$row['nProfit'] = number_format($row['total_price'] * 0.3, 0, '.', '');
			unset($row['total_price']);
            array_push($rows, $row);
        }
    }
	return $rows;
}
?>
		