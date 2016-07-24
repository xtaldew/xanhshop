<?php
if(!session_id())
	session_start();

error_reporting(0);

require("config.php");
require("common_start.php");
require("lib/func.lib.php");

?>
<!DOCTYPE html>
<html>
<head>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="chuyên cung cấp các loại cây hoa văn phòng, terrarium, cầu thủy tinh, chậu trồng hoa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Xanh Shop - Tiểu cảnh, cây hoa văn phòng, cầu thủy tinh</title>
<script language="javascript" src="lib/varAlert.<?php echo $_lang?>.unicode.js"></script>
<script language="javascript" src="lib/javascript.lib.js"></script>
<script language="javascript">
function btnSearch_onclick(){
	if(test_empty(document.frmSearch.keyword.value)){
		alert(mustInput_Search);document.frmSearch.keyword.focus();return false;
	}
	document.frmSearch.submit();
	return true;
}

</script>

<link href="css/css.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<!--div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script-->
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><img src="Hinh/space.jpg" width="5"></td>
  </tr>
  <!-- row 2 -->
  <tr>
    <td align="center" width="100%" bgcolor="#FFFFFF">
      <a href="http://hatgionghoadep.tk" target="_blank" style="border:none;">
      <img align="center" style="border:none;" src="banner.jpg"/></a>
    </td>
  </tr>
  <!-- row 3 -->
  <tr>
    <td bgcolor="#FFFFFF" height="20"></td>
  </tr>
  <!-- row 4 -->
  <tr>
    <td align="center" height="40" bgcolor="#32cd32">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		  <td width="14%" align="center"><a href="./" class="link1">TRANG CHỦ</a></td>
		  <td width="14%" align="center"><a href="./?frame=product" class="link1">SẢN PHẨM</a></td>
		  <td width="14%" align="center"><a href="./?frame=news" class="link1">TIN TỨC</a></td>
		  <td width="14%" align="center"><a href="./?frame=thanhtoan" class="link1">THANH TOÁN</a></td>
		  <td width="14%" align="center"><a href="./?frame=contact" class="link1">LIÊN HỆ</a></td>
		  <td width="28%"><table align="center"><tr>
		  <td style="padding-right: 15px"><img src="images/icon_search.gif" width="18" height="18"/></td>
		  <form action="./" method="get" name="frmSearch">
			<input type="hidden" name="act" value="search"/>
			<input type="hidden" name="frame" value="search"/>
			<td style="padding-right: 15px"><input name="keyword" type="text" class="search" value="Nhập từ khóa..." onFocus="this.value='';"/></td>
			<td><input name="Submit" type="submit" class="style19" value="Tìm kiếm nhanh! " onClick="return btnSearch_onclick();"/></td>
		  </form>
		  </tr></table></td>
        </tr>
      </table>
	</td>
  </tr>
  <!--tr><td width="100%" align="center" style="padding-top:20px"><font size=4 color="#3399ff">
     <marquee height="30" behavior="scroll" direction="left" scrolldelay="100" scrollamount="7" onMouseOver="this.stop();" onMouseOut="this.start();">
         TRANG WEB NAY DANG TRONG QUA TRINH HOAN THIEN. XIN THONG CAM !
     </marquee></font></td></tr-->
  <tr><td height="10"></td></tr>
  <tr><!--td width="100%"><table width="100%"><tr><td width="80%" align="left">
  	<div valign="center" class="fb-share-button" data-href="http://hocdientu.tk/" data-layout="button">Chia se tren Facebook</div>
     	<div style="padding-left:20px" class="g-plusone" data-size="medium" data-annotation="none" valign="center"> Chia se trong G+</div>
  </td-->
  <td width="100%" align="center">
     <!--a href="./?frame=login" style="text-decoration: none; font-size:14pt">Login <font size=2>or</font> Register</a-->
     <?php include('module/login.php') ?>
  </td>
  <!--/tr></table></td></tr-->
  </tr>   
  <tr><td height="0"></td></tr>
  <!-- row 5 -->
  <tr>
    <td class="style4">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
          <td width="250">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="style15" cellpadding="5">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100%"><?php include('module/product_category.php')?></td>
                    </tr>
					<tr>
                      <td><br/></td>
                    </tr>
				  </table>
				</td> 
              </tr> <!-- end of Danh muc 1-2-3-4 -->
			 
			  <tr>
                <td class="style15">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100%"><img src="images/httt.jpg" width="100%" height="29" /></td>
                    </tr>
                    <tr>
                      <td class="style5">
						  <table width="190" border="0" cellspacing="1" cellpadding="1">
                            <tr>
                              <td height="20" colspan="2" align="center" valign="top">
							    <table width="160" border="0" align="center">
                                  <tr>
                                    <td align="center"><img src="images/hotline.jpg" alt="hot line" width="165" height="49"/></td>
								  </tr>
                                  <tr>								  
                                    <td align="center"><a href="bando/sodo.php" target="_blank"><img src="images/sodo.gif" width="165" height="49" border="0"/></a></td>
                                  </tr>
                                </table>
							  </td>
                            </tr>
						    
						    <tr>
							  <td align="center"><?php include('box/box_skype.php')?></td>
						    </tr>
                          </table>
					  </td>
                    </tr>
                  </table>
				</td>
              </tr>
			  <!--tr><td align="center" width="100%">
			  <- AdMashMedia.com Unitevsal Ad Tag ->
<script type="text/javascript">
var admveddn = "95";
var admveacf = "144";
var admvedrl = "R2VuZXJhbCBDYXRlZ29yeQ==";
var admvecvd = Math.floor((Math.random() * 1000000000000));
</script>
<script type="text/javascript" src="http://radiumnetwork.net/radiumserver/taguniversal.js"></script>                    
			  </td></tr-->
			  <tr> <!-- start of thong ke luong truy cap -->
                <td class="style15">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="style17">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="3%"><img src="images/c_bg1.jpg" width="6" height="29" /></td>
                            <td width="97%" class="style11">THỐNG KÊ TRUY CẬP</td>
                          </tr>
                        </table>
					  </td>
                    </tr>
					<tr>
                      <?php include('box/box_total.php')?>
					</tr>
                  </table>
				</td>
              </tr>
              <tr>
                <td class="style15"><?php include('box/box_left_bottom.php')?></td>
              </tr>
            </table>
		  </td>	  
	      
          <td> <!-- column 2: main S&#7843;n ph&#7849;m m&#7899;i, tin t&#7913;c s&#7921; ki&#7879;n -->
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="style16">
				  <?php if(empty($_REQUEST['frame'])) {
				    include('module/home.php');
				  } else {?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="style17">
					    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="6"><img src="images/c_bg1.jpg" width="6" height="29" /></td>
                            <td class="style11"><?php include('module/processTitle.php')?></td>
                          </tr>
                        </table>
					  </td>
                    </tr>
                    <tr>
                      <td class="style20">
					    <table width="100%" border="0">
                          <tr>
                            <td><?php include('module/processFrame.php')?></td>
                          </tr>
                        </table>
					  </td>
                    </tr>
                  </table><?php 
				  } ?>
                </td>
              </tr>
			<tr><td height="20px"></td></tr>
            </table>
	      </td>
		  <!-- cot ben phai -->
          <td width="193">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="style15">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="images/cart_bg1.jpg" width="193" height="7" /></td>
                    </tr>
                    <tr>
                      <td class="style7">
					    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="43%" rowspan="2" align="center"><img src="images/cart.jpg" width="62" height="58" /></td>
                            <td width="57%" class="style9"><a href="./?frame=cart" style="text-decoration: none">GIỎ HÀNG</a></td>
                          </tr>
                            <?php $cnt=0;
					        $tongcong=0;
					        $cart=$_SESSION['cart'];if ($cart<>''){
					        foreach ($cart as $product){
						    $sql = "select * from tbl_product where id='".$product[0]."'";
						    $result = mysql_query($sql,$conn);
						    if (mysql_num_rows($result)>0){
						    $pro = mysql_fetch_assoc($result)?>
                            <?php }
					        $tongcong=$tongcong+$product[1];
					        $cnt=$cnt+1;
					        }} ?>
                          <tr>
                            <td valign="top" class="style8"><span class="style10"><?php echo $tongcong?></span> Sản phẩm</td>
                          </tr>
                        </table>
					  </td>
                    </tr>
                    <tr>
                      <td><img src="images/cart_bg2.jpg" width="193" height="7" /></td>
                    </tr>
                  </table>
				</td>
              </tr>
             
              <tr>
                <td class="style15"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="style17">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="3%"><img src="images/c_bg1.jpg" width="6" height="29" /></td>
                          <td width="97%" class="style11">SẢN PHẨM BÁN CHẠY<img src="images/new.gif" width="33" height="16" align="absmiddle" /></td>
                        </tr>
                      </table>
					</td>
                  </tr>
                  <tr>
                    <td class="style12">
					  <marquee height="300" behavior="scroll" direction="up" scrolldelay="100" scrollamount="3" onMouseOver="this.stop();" onMouseOut="this.start();">
                            <?php include('module/product_special.php')?>
                      </marquee>
                    </td>
                  </tr>
                </table></td>
              </tr>
             
            </table>
	      </td>
        </tr>
      </table>
	</td>
  </tr>
<tr><td width="100%" align="center" style="padding-top:20px; padding-bottom:40px"><table align="center"><tr><td><a href="https://www.youtube.com/channel/UCNlAA2SyalW68dVMW3YvEtQ">
	  <img height="50" src="http://www.k9workingdogs.nl/Images/youtubelogo.jpg" />
	  </a></td>
	  <td style="padding-left:250px"><a href="https://www.facebook.com/C%C3%A2y-B%E1%BA%A1c-H%C3%A0-582422828531735/?fref=ts">
	  <img height="50" src="http://bullcitycrossfit.com/wp-content/uploads/2014/04/Like-Us-On-Facebook.jpeg" />
	  </a></td>
	  <td style="padding-left:250px"><a href="https://www.youtube.com/channel/UCNlAA2SyalW68dVMW3YvEtQ">
	  <img height="50" src="http://www.ekostconstruction.ca/wp-content/uploads/2011/08/follow-us-on-twitter.png" />
	  </a></td>
	  </tr></table></td></tr>
  <tr>
    <td bgcolor="#66cdaa" align="center"><br>
	  <strong>Copyright@ XanhShop 2016</strong><br>
            &#272;&#7883;a ch&#7881;: Cầu Giấy, Hà Nội<br>
            &#272;i&#7879;n tho&#7841;i: +84 1674 623 889<br><br>
	</td>
  </tr>
</table>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57112802e2cf383c"></script>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66893125-8', 'auto');
  ga('send', 'pageview');

</script>
<!-- End Google Analytics -->
</body>
</html>
<?php require("common_end.php"); ?>		
