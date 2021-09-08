<?php
//상품자료
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
		