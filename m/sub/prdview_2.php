<?
$sub_tit="상품보기";
?>
<? include "../inc/header.php" ?>
<body>
<? include "../inc/gnb.php" ?>
<? include "../inc/search.php" ?>
<? include "../inc/sub_title.php" ?>

<div class="prd_view">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="75" valign="top"><img src="../img/sub/item_01.jpg" width="75" height="75" /></td>
        <td style="padding-left:15px;" valign="top">
        	<div class="prd_tit">3M 983D-326 차량안전용 고휘도 반사(5cm폭) 롤 판매 백/적색 (15cm간격)</div>
            <div style="padding-top:8px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_normal">
              <tr>
                <th>상품가격</th>
                <td><font class="prd_price">145,000원</font></td>
              </tr>
              <tr>
                <th>적립금</th>
                <td>1,450원</td>
              </tr>
            </table>
            </div>
            <div style="padding-top:5px;"><input type="button" value="Photo Gallery ▶" class="btn_gray_small" style="width:80px;" /></div>
        </td>
      </tr>
    </table>
</div>
<div class="prd_view_tab">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="prdview_1.php">상품정보</a></td>
    <th><a href="prdview_2.php">상품 상세보기</a></th>
    <td><a href="prdview_3.php">상품리뷰<small>(1)</small></a></td>
  </tr>
</table>
</div>

<div style="padding-top:10px; padding-bottom:10px; text-align:center;"><img src="../img/sub/image.gif" /></div>
<div class="more_view"><a href="#">▼ 더보기</a></div>


<div class="btn">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0" align="left"><tr><td width="5"><img src="../img/sub/btn_gray_left.gif" /></td><td><input type="button" class="btn_order" value="구매하기" onClick="location.href='payment.php'" /></td><td width="5"><img src="../img/sub/btn_gray_right.gif" /></td></tr></table></td>
    <td align="center" style="padding-left:5px; padding-right:5px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td width="5"><img src="../img/sub/btn_white_left.gif" /></td><td><input type="button" class="btn_etc" value="장바구니" onClick="location.href='cart.php'" /></td><td width="5"><img src="../img/sub/btn_white_right.gif" /></td></tr></table></td>
    <td align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="5"><img src="../img/sub/btn_white_left.gif" /></td><td><input type="button" class="btn_etc" value="관심상품" onClick="location.href='wishlist.php'" /></td><td width="5"><img src="../img/sub/btn_white_right.gif" /></td></tr></table></td>
  </tr>
</table>
</div>
<? include "../inc/footer.php" ?>
</body>
</html>