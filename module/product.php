<?php 
$row = 2;
$col = 3;

$p=0;
if ($_REQUEST['p']!='') $p=$_REQUEST['p'];

$sql = "select * from tbl_product where 1 order by date_added desc limit ".$row*$col*$p.",".$row*$col;
if($_REQUEST['catagory']!='') {
	$catagory = $_REQUEST['catagory'];
	$sql = "select * from tbl_product where catagory=".$catagory." order by date_added desc limit ".$row*$col*$p.",".$row*$col;
} 

$result = @mysql_query($sql,$conn);

$total = countRecord("tbl_product");
if($_REQUEST['catagory']!='') 
	$total = countRecord("tbl_product", "catagory=".$catagory);

if($total==0) {
?>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<table align="center" cellSpacing="0" cellPadding="0" width="100%" border="0">
	<tr><td height="10"></td></tr>
	<tr>
		<td align="center">
			<font color="#000000"><strong><?php echo $_lang=="vn"?'Sản phẩm đang cập nhật !':'Products are being updated !'?></strong></font>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
</table>
<?php }else{
?>
<table align="center" cellSpacing="0" cellPadding="0" width="100%" border="0">
<?php for($i=0; $i<$row; $i++){
?>
	<tr><td width="10"></td>			  					
<?php for($j=0; $j<$col&&$products=mysql_fetch_assoc($result); $j++){
		$pro = getRecord("tbl_product","id=".$products['id'])?>
		
		<td width="30%" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr><td height="10px"></td></tr>
			<tr>
			  <td align="center" class="style13"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" title="<?php echo $pro['name']?>">  
			  	<?php 
					if($pro['icon']!='')
					{ ?>
							<img src="<?php echo $pro['icon'] ?>" width="100%" height="400" border="0" />
				<?php }?>
			  	</a></td>
			</tr>
			<tr>
            <td height="25" align="center"><a href="./?frame=product_detail&id=<?php echo $pro['id']?>" class="link4"><?php echo $pro['name']?><br>Gia:&nbsp;<?php echo $pro['price']?>&nbsp;VND</a></td>
             </tr>
         </table><td width="10"></td>								
            <?php }
while($j<$col){
	echo "";
	$j=$j+1;
}
?></td>
	</tr>	  
<?php }?>
</table>
<table width="98%" border="0" cellpadding="0" cellspacing="0">
   <tr>
        <td colspan="2" id="boder_button">&nbsp;</td>
   </tr>
   <tr><td height="5px"></td></tr>
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
echo '<tr><td class="smallfont" align="left"><b>'.$total.'</b> '.$newsPage.'</td>';
echo '<td class="smallfont" align="right">'.$pagePage.' : ';
$param="";
if ($p>1) echo '<a class="aLink3" title="'.$titleFirst.'" href="./?frame='.$_REQUEST['frame'].'&catagory='.$_REQUEST['catagory'].'&'.$param.'&p=0">[&lt;&lt;]</a> ';
if ($p>0) echo '<a class="aLink3" title="'.$titlePrevious.'" href="./?frame='.$_REQUEST['frame'].'&catagory='.$_REQUEST['catagory'].'&'.$param.'&p='.($p-1).'">[&lt;]</a> ';
$from=($p-10>0?$p-10:0);
$to=($p+10<$pages?$p+10:$pages);
for ($i=$from;$i<$to;$i++){
	if ($i!=$p) echo '<a class="aLink3" href="./?frame='.$_REQUEST['frame'].'&catagory='.$_REQUEST['catagory'].'&'.$param.'&p='.$i.'">'.($i+1).' </a>';
	else echo '<b>'.($i+1).'</b> ';
}
if ($p<$i-1) echo '<a class="aLink3" title="'.$titleNext.'" href="./?frame='.$_REQUEST['frame'].'&catagory='.$_REQUEST['catagory'].'&'.$param.'&p='.($p+1).'">[&gt;]</a> ';
if ($p<$pages-1) echo '<a class="aLink3" title="'.$titleLast.'" href="./?frame='.$_REQUEST['frame'].'&catagory='.$_REQUEST['catagory'].'&'.$param.'&p='.($pages-1).'">[&gt;&gt;]</a>'; 
echo '</td></tr>';
?>
</table><br />

<?php }?>
