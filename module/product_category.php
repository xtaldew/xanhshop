<link href="../css/css.css" rel="stylesheet" type="text/css" />
<table width="100%"  border="0" cellspacing="0" cellpadding="0">	
  <tr><td style="background-color:#4F7274;border-bottom:1px #ccc solid;height:40px;">
	<img src="" width="5" height="9" /><font size="5pt" color="#FF55FF"><b>Tất cả danh mục</b></font>
  </td></tr>
<?php 
$sqlp = "select * from tbl_product_category where 1 order by sort";
$resultp = mysql_query($sqlp,$conn);
while($rowp = mysql_fetch_assoc($resultp)) { ?>		
	<tr>
        <td style="padding-left:10px;background-color:#4682b4;border-bottom:1px #ccc solid;height:30px;"><a href="./?frame=product&catagory=<?php echo $rowp['id']?>" style="text-decoration: none"><img src="images/icon_1.gif" width="25" height="9" /><font size="4pt" color="#FFFFFF"><b><?php echo $rowp['name']?></b></font></a></td>
    </tr>				
<?php }?>

</table>
