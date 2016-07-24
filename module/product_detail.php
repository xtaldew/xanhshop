<?php $pro = getRecord("tbl_product", "id=".$_REQUEST['id']);?>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script>
function changeImg(src) {
    var x = document.getElementById("lgImg");
    x.setAttribute("src", src);
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td width="60%">
	<table width="100%">
		<tr>
			<td width="100%" align="center" valign="top"><img id="lgImg" height="512" src="<?php echo $pro['icon'] ?>" border="0"/></td>
		</tr>
		<tr>
			<td width="100%" align="center">      
				<?php if($pro['image1']!='') {?><img type="button" onclick="changeImg('<?php echo $pro['image1'] ?>')" style="padding-right:3px" width="19%" src="<?php echo $pro['image1'] ?>" border="0"/><?php }?>
				<?php if($pro['image2']!='') {?><img type="button" onclick="changeImg('<?php echo $pro['image2'] ?>')" style="padding-right:3px" width="19%" src="<?php echo $pro['image2'] ?>" border="0"/><?php }?>
				<?php if($pro['image3']!='') {?><img type="button" onclick="changeImg('<?php echo $pro['image3'] ?>')" style="padding-right:3px" width="19%" src="<?php echo $pro['image3'] ?>" border="0"/><?php }?>
				<?php if($pro['image4']!='') {?><img type="button" onclick="changeImg('<?php echo $pro['image4'] ?>')" style="padding-right:3px" width="19%" src="<?php echo $pro['image4'] ?>" border="0"/><?php }?>
				<?php if($pro['image5']!='') {?><img type="button" onclick="changeImg('<?php echo $pro['image5'] ?>')" width="19%" src="<?php echo $pro['image5'] ?>" border="0"/><?php }?>
			</td>
		</tr>
	</table>
	</td>
	<td width="5%"></td>
	<td width="35%"><table>
		<tr>
			<p><span class="style9">
			<?php echo $pro['name']?>
			</span>&nbsp; <strong>(Mã số:
			  <?php echo $pro['code']?>
			  )</strong></p>
			<?php
					if($pro['price']>0){?>
			<p><span class="style30">Giá : </span>
				  <?php echo number_format($pro['price'],0,',','.') ?>&nbsp;&nbsp;
			  <?php echo $currencyUnit?>
			  </p>
			<?php }
					else {?>
			<p style="font-family:Tahoma; font-size:12px">Liên hệ </p>
			<?php }
				?>
			<p><a href="./?frame=cart&amp;p=<?php echo $pro['id']?>" class="link5"> <img src="images/cart_1.jpg" width="20" height="17" vspace="2" border="0" align="absmiddle" />&nbsp;&nbsp;Đặt hàng &nbsp;&nbsp;</a></p>
		</tr>
		<tr>
		  <td align="left">
			<h3>Thông tin chi tiết sản phẩm:</h3><hr /> 
		  </td>
		</tr>
		<tr>
		  <td><?php echo $pro['short_detail']?></td>
		</tr>
		</table>
	</td>
	</tr>
	<tr><td colspan=3><br><h1>Mô tả đầy đủ</h1><hr />
		<?php echo $pro['full_detail']?>
	</td></tr>
	<tr>
		<td colspan=3 width="100%" align="left" style="padding-top:20px"><hr>
		<?php include('comment.php'); ?></td>
	</tr>
</table>

<?php $row = 3;
$col = 4;
$$cat=0;
$p=0;
$per_page = 10;
if ($_REQUEST['p']!='') $p=killInjection($_REQUEST['p']);

$sql = "select * from tbl_product where status=0 AND id<>'".$pro['id']."' AND parent=".$pro['parent']." order by sort,date_added desc limit ".$per_page*$p.",".$per_page;

$result = @mysql_query($sql,$conn);
$total = countRecord("tbl_product","status=0 AND id<>'".$pro['id']."' AND parent=".$pro['parent']);

if($total==0){

?>

<?php }else{
?>
<hr size="1" style="border-bottom:solid; color:#999999" width="100%"/>
	<span style="font-family:Tahoma; font-size:12px; color:#333333; padding-left:5px;padding-top:10px"><strong>Sản phẩm khác : </strong></span>
<br />
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<?php for($i=0; $i<$row; $i++){
?>
	<tr>			  			
<?php for($j=0; $j<$col&&$products=mysql_fetch_assoc($result); $j++){
		$pro = getRecord("tbl_product","id=".$products['id'])?><td width="10px"></td><td>
		<table width="130" border="0" cellspacing="0" cellpadding="0" style="float:left">
			<tr><td height="10px"></td></tr>
			<tr>
			  <td align="center" class="style13"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" title="<?php echo $pro['name']?>">  
			  	<?php 
					if($pro['image']!='' || $pro['image_large']!='')
					{ $img = $pro['image']!='' ? $pro['image'] : $pro['image_large'];
						?>
							<img src="<?php echo $img?>" width="120" height="100" border="0" />
						<?php }
				?>
			  	</a></td>
			</tr>
			<tr>
            <td height="25" align="left"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" class="link4"><?php echo $pro['name']?></a></td>
          </tr>
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
<table width="98%" border="0">
 <tr><td width="100%" style="padding-top:5px"><hr size="1" style="border-bottom:solid; color:#999999" width="100%"/></td></tr>
</table>
<table align="center" cellSpacing=0 cellPadding=0 width="98%" border=0>

<?php $newsPage       = $_lang=="vn" ? "Sản phẩm" : "Products";
$pagePage       = $_lang=="vn" ? "Trang" : "Page";
$titleFirst     = $_lang=="vn" ? "Đầu Tiên" : "First";
$titlePrevious  = $_lang=="vn" ? "Về trước" : "Previous";
$titleNext      = $_lang=="vn" ? "Tiếp theo" : "Next";
$titleLast      = $_lang=="vn" ? "Cuối cùng" : "Last";

$pages = countPages($total,$row*$col);
echo '<tr><td colspan="2" align="center"></td></tr>';
echo '<tr><td class="smallfont" align="left" style="padding-left:8px; padding-top:5px"><b>'.$total.'</b> '.$newsPage.'</td>';
echo '<td class="smallfont" align="right">'.$pagePage.' : ';
$param="";
if ($p>1) echo '<a class="aLink3" title="'.$titleFirst.'" href="./?frame='.$_REQUEST['frame'].'&id='.$_REQUEST['id'].$param.'&p=0">[&lt;&lt;]</a> ';
if ($p>0) echo '<a class="aLink3" title="'.$titlePrevious.'" href="./?frame='.$_REQUEST['frame'].'&id='.$_REQUEST['id'].$param.'&p='.($p-1).'">[&lt;]</a> ';
$from=($p-10>0?$p-10:0);
$to=($p+10<$pages?$p+10:$pages);
for ($i=$from;$i<$to;$i++){
	if ($i!=$p) echo '<a class="aLink3" href="./?frame='.$_REQUEST['frame'].'&id='.$_REQUEST['id'].$param.'&p='.$i.'">'.($i+1).' </a>';
	else echo '<b>'.($i+1).'</b> ';
}
if ($p<$i-1) echo '<a class="aLink3" title="'.$titleNext.'" href="./?frame='.$_REQUEST['frame'].'&id='.$_REQUEST['id'].$param.'&p='.($p+1).'">[&gt;]</a> ';
if ($p<$pages-1) echo '<a class="aLink3" title="'.$titleLast.'" href="./?frame='.$_REQUEST['frame'].'&id='.$_REQUEST['id'].$param.'&p='.($pages-1).'">[&gt;&gt;]</a>'; 
echo '</td></tr>';
?>
</table><br />
 
<?php }?> 
