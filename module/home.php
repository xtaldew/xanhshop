<link href="../css/css.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="style17"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="6"><img src="images/c_bg1.jpg" width="6" height="29" /></td>
                          <td class="style11">SẢN PHẨM MỚI <img src="images/new.gif" width="33" height="16" align="absmiddle" /></td>
                        </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td class="style20" align="center" width="100%">
					  	<?php $row = 5;
$col = 4;

$cat = 0;
if($_REQUEST['cat']!='') $cat=killInjection($_REQUEST['cat']);

$p_new=0;
if ($_REQUEST['p_new']!='') $p_new=$_REQUEST['p_new'];
$sql = "select * from tbl_product where 1 order by date_added desc limit 0,8";
$result = @mysql_query($sql,$conn);
$total = countRecord("tbl_product");
if($total==0){
?>
<table align="center" cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr><td height="10"></td></tr>
	<tr>
		<td align="center">
			<font color="#FFFFFF"><strong><?php echo $_lang=="vn"?'Sản phẩm mới đang cập nhật !':'Products are being updated !'?></strong></font>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
</table>
<?php }else{
?>

<table align="center" cellSpacing="0" cellPadding="0" width="100%" border="0">
<?php for($i=0; $i<$row; $i++){
?>	<tr>			  	
<?php for($j=0; $j<$col&&$products=mysql_fetch_assoc($result); $j++){
		$pro = getRecord("tbl_product","id=".$products['id'])?><td align="center" width="300" style="padding-top:15px">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td align="center" class="style13"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" title="<?php echo $pro['name']?>">  
			  	
							<img src="<?php echo $pro['icon']?>"width="300" height="300" border="0" />
				
			  	</a>
				</td>
			</tr>
			<tr>
            <td height="25" align="center"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" class="link4">
              <?php echo $pro['name']?>
            </a><br />   Giá : <?php echo number_format($pro['price'],0,',','.') ?> <?php echo $currencyUnit?>
                    <br><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" class="link4">
                </a></td>
             </tr>
			 <tr><td height="10"></td></tr>
         </table>				
            <?php }
while($j<$col){
	echo "";
	$j=$j+1;
}
?></td>
	</tr>	  
<?php }?>
</table>

<?php }?>					 </td>
                    </tr>
             </table>
	</td>
  </tr>
  <!-- +++++++++++++++++++++++++++++++++++++++++++++ -->
<tr>
  <td class="style4"><table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	  <td class="style17"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="6"><img src="images/c_bg1.jpg" width="6" height="29" /></td>
		  <td class="style11">TIN TỨC &amp; SỰ KIỆN <img src="images/new.gif" width="33" height="16" align="absmiddle" /></td>
		</tr>
		</table></td>
	</tr>
	<!-- +++++++++++++++++++++++ -->
	<tr>
		<td style="padding-left:10px;padding-bottom:10px;padding-right:10px;padding-top:0px;" class="style4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php $code = $_lang == 'vn' ? 'vn_news' : 'en_news';
	$parentWhere = "and parent = (select id from tbl_content_category where code='".$code."')";								
	$parentRecord = getRecord("tbl_content","1=1 ".$parentWhere);								
	$cat = killInjection($_REQUEST['cat']);
	if ($cat=='') $cat = $parentRecord['parent'];
	$per_page =2;
	$p=0;
	if ($_REQUEST['p']!='') $p=killInjection($_REQUEST['p']);								
	$sql = "select * from tbl_content where status=0 $parentWhere order by sort,date_added desc limit 0,".$per_page;
	$result = @mysql_query($sql,$conn);
	$ztotal=countRecord("tbl_content", "parent=".$parentWhere);
	while($row=mysql_fetch_assoc($result)){
	?>
	   <tr><td height="20px"></td></tr>
	   <tr><td valign="top" class="style21">
	  <a href="./?frame=news_detail&amp;id=<?php echo $row['id']?>"><img src="<?php echo $row['image']?>" width="130" height="100" border="0" /></a></td>
	  <td valign="center" align="left><table align="left"><table><tr><td><a href="./?frame=news_detail&id=<?php echo $row['id']?>" class="link5"><?php echo $row['name']?></a></td>
	</tr>
	<tr>
	  <td valign="center" class="style19"><?php echo $row['detail_short']?></td>
	</tr>
	<tr>
	  <td valign="center" class="style19" style="padding-top:5px"><a href="./?frame=news_detail&id=<?php echo $row['id']?>">
	  	<img src="images/more.gif" width="49" height="11" border="0"/></a></td>
	</tr>
		</table></td></tr>
			<?php }
			?>		
	</table></td>
   </tr><?php if($ztotal>$per_page) { ?>
	<tr><td height="30px"></td></tr>
	<tr><td><h2>Xem thêm </h2><hr /></td></tr>	
	<tr><td height="15px"></td></tr><?php } ?>		
	<?php $code = $_lang == 'vn' ? 'vn_news' : 'en_news';
	$parentWhere = "and parent = (select id from tbl_content_category where code='".$code."')";						
	$parentRecord = getRecord("tbl_content","1=1 ".$parentWhere);						
	$cat = killInjection($_REQUEST['cat']);
	if ($cat=='') $cat = $parentRecord['parent'];
	$per_page = 2;
	$p=1;
	$p1=4;
	if ($_REQUEST['p']!='') $p=killInjection($_REQUEST['p']);						
	$sql = "select * from tbl_content where status=0 $parentWhere order by sort,date_added desc limit ".$per_page*$p.",".$p1;
	$result = @mysql_query($sql,$conn);
	while($row=mysql_fetch_assoc($result)){
	?>
	 <tr>
		 <td style="padding:2px 0px 2px 0px"><img src="images/icon_2.gif" width="17" height="6" />
			<a href="./?frame=news_detail&id=<?php echo $row['id']?>" class="link6"><?php echo $row['name']?></a> 
			<em class="style23">(<?php echo dateFormat($row['last_modified'])?>)</em><br /> 								
		 </td>
	 </tr>
	<?php }?>	
	</table></td>
</tr>
</table>
