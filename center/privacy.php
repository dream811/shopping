<?
include "../inc/common.inc"; 			// DB컨넥션, 접속자 파악
include "../inc/util.inc"; 		   	// 유틸 라이브러리

$now_position = "<a href=/>Home</a> &gt; 고객센터 &gt; <strong>개인정보취급방침</strong>";
$page_type = "privacy";

include "../inc/page_info.inc"; 	// 페이지 정보
include "../inc/header.inc"; 			// 상단디자인

?>

<div class="AW_ttl clearfix">
	<h2>개인정보처리방침</h2>
	<div class="his_bar clearfix">
		<a href="/" class="home_ico">Home</a><span>개인정보처리방침</span>
	</div>
</div>
<? include $_SERVER['DOCUMENT_ROOT'].'/inc/lnk_nav.php'; // 상단메뉴 ?>
<div class="page_area">
	<?=$page_info->content?>
</div>

<?

include "../inc/footer.inc"; 		// 하단디자인

?>