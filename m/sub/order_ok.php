<?
$sub_tit="주문 완료";
?>
<? include "../inc/header.php" ?>
<? include "../inc/sub_title.php" ?>
<div class="gry_bar"></div>
<?php
///////////////////////////////////////////
/// PG사 결제 완료시 꼭 반환되어야할 값들//
///////////////////////////////////////////
/* $orderid : 주문번호
/* $resmsg : 오류 및 반환 메세지
/* $rescode : 성공반환 메세지
/* $pay_method : wizshop 결제종류
*//////////////////////////////////////////

//if($pay_method != "PB"){
	//Pay_result($oper_info->pay_agent);
	$presult=Pay_result($oper_info->pay_agent,$rescode);

  //////// 쓰레기 장바구니 데이터 삭제 ////////////
  @mysqli_query($connect, "delete from wiz_basket_tmp WHERE wdate < (now()- INTERVAL 10 DAY)");
//}
$now_position = "<a href=/>Home</a> &gt; 주문하기 &gt; 주문완료";
$page_type = "ordercom";

include "../../inc/page_info.inc"; 		// 페이지 정보

// 주문정보
$sql = "SELECT * FROM wiz_order WHERE orderid = '$presult['orderid']'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$order_info = mysqli_fetch_object($result);

// 주문성공
if($presult[rescode] == "0000" && strlen($presult[rescode]) == 4){

	// 주문완료 메일/sms발송
	include "../../shop/order_mail.inc";		// 메일발송내용

	$re_info[name] = $order_info->send_name;
	$re_info[email] = $order_info->send_email;
	$re_info[hphone] = $order_info->send_hphone;

	// email, sms 발송 체크
	$sql = "update wiz_order set send_mailsms = 'Y' where orderid = '$order_info->orderid'";
	mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($order_info->send_mailsms != "Y") send_mailsms("order_com", $re_info, $ordmail);
?>
	<div class="order_ok">
		<h3><?=$order_info->send_name?>님의 주문이 완료되었습니다.</h3>

		<p>
		<? if($order_info->reserve_price > 0) { ?>
		귀하의 제품 구입에 따른 적립금 <?=number_format($order_info->reserve_price)?>원은<br />
		배송과 함께 바로 적립됩니다.<br />
		<? } ?>
		입금방법이 무통장입금의 경우 계좌번호를 메모하세요.<br />
		입금 확인 후 상품을 준비하여 배송해 드리겠습니다.
		</p>
	</div>

	<div class="gry_bar"></div>
	<? include "./order_info.inc"; ?>


	<div class="button_common">
		<button type="button" onClick="goURL('orderlist.php')">주문내역 확인하기</button>
	</div>
	
<?php
// 주문실패
}else{
?>
	<div class="order_ok">
		<h3>결제 시 에러가 발생하였습니다.</h3>
		<p>
		결과메세지 : <?=$presult[resmsg]?>
		</p>
	</div>

	<div class="button_common">
		<button type="button" onClick="goURL('order_pay.php?orderid=<?=$presult['orderid']?>&pay_method=<?=$order_info->pay_method?>')">다시 결제</button>
	</div>
	
<?php
}
?>

<? include "../inc/footer.php" ?>
