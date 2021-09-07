<?php
//상품자료
function getProducts($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 상품넘버 만들기
	$sql = "select wiz_product.prdcode, prdname, prdcom, origin, stock, sellprice, conprice, supprice, reserve, new, best, popular, recom, sale, mallid prdimg_R as main_image, prdimg_L1 as large_Image, prdimg_M1 as medium_image, prdimg_S1 as small_image, wiz_category.catname as category_name from wiz_product left join wiz_cprelation on wiz_product.prdcode = wiz_cprelation.prdcode left join wiz_category on wiz_cprelation.catcode = wiz_category.catcode where status='Y' limit $pageSize offset $lastIndex";
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
function getOrders($lastIndex = 0, $pageSize = 100)
{
    global $connect;
    // 상품넘버 만들기
	$sql = "select orderid, send_id, send_name, send_tphone, send_hphone, send_email, send_post, send_address, rece_name, rece_tphone, rece_hphone, rece_address, pay_method, account, reserve_price, deliver_method, deliver_price, deliver_date, prd_price, total_price, order_date, pay_date, send_date from wiz_order limit $pageSize offset $lastIndex";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	
	$rows=[];
    if (mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
            array_push($rows, $row);
        }
    }
    
	
	return $rows;
}
?>
		