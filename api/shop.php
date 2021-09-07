<?

include_once "../inc/common.inc"; 		// DB컨넥션, 접속자 파악
include_once "../inc/util.inc"; 		// 라이브러리 함수
include_once('./db.process_shop.php');//db config

$type = $_REQUEST['type'];
//$page_num = isset($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 100;
$last_index = isset($_REQUEST['last_index']) ? $_REQUEST['last_index'] : 0;
$page_size = isset($_REQUEST['page_size']) ? $_REQUEST['page_size'] : 100;


switch ($type) {
	case 'products':
		$response_array = array();
		$response_array['status'] = 'success';
		$response_array['data'] = getProducts($last_index, $page_size);
		echo (json_encode($response_array));
		break;
	case 'orders':
		$response_array = array();
		$response_array['status'] = 'success';
		$response_array['data'] = getOrders($last_index, $page_size);
		echo (json_encode($response_array));
		break;
	case 'categories':
		$response_array = array();
		$response_array['status'] = 'success';
		$response_array['data'] = getCategories($last_index, $page_size);
		echo (json_encode($response_array));
		break;
	case 'sellData':
		$sell_date = isset($_REQUEST['strStartDate']) ? $_REQUEST['strStartDate'] : "1900-01-01 10:00:00";
		$shop_agent = isset($_REQUEST['strShopAgent']) ? $_REQUEST['strShopAgent'] : "";
		//$response_array = array();
		//$response_array['status'] = 'success';
		$response_array = getSellData($sell_date, $shop_agent);
		echo (json_encode($response_array));
		break;
	default:
		# code...
		break;
}
?>