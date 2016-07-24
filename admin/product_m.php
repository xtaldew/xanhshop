<script type="text/javascript" src="../jscripts/FCKeditor/fckeditor.js"></script>
    <script type="text/javascript">
      window.onload = function()
      {
        var oFCKeditor = new FCKeditor( 'txtFullDetail' ) ;
        oFCKeditor.BasePath = "../jscripts/FCKeditor/" ;
		oFCKeditor.Width = "720" ; 
		oFCKeditor.Height = "300" ; 
        oFCKeditor.ReplaceTextarea() ;	
      }
</script>

<?php // Config
$tableCategoryConfig = 'tbl_product_category';
$tableConfig         = 'tbl_product';
$actConfig           = 'product';
//$parentWhereConfig   = 'parent<>0';

$path = "../images/product";
$pathdb = "images/product";

?>
<?php if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	echo '<script language="javascript" src="../lib/scripts/editor.js"></script>';

else
	echo '<script language="javascript" src="../lib/scripts/moz/editor.js"></script>';
?>



<script language="javascript">

function btnSave_onclick(){
	if(test_empty(document.frmForm.txtName.value)){
		alert('Hãy nhập "tên" !');
		document.frmForm.txtName.focus();
		return false;

	}	
	if(test_integer(document.frmForm.txtSort.value)){
		alert('"Thứ tự sắp xếp" phải là số !');
		document.frmForm.txtSort.focus();
		return false;
	}
	return true;
}

</script>

<?php $errMsg =''?>

<?php if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$catagory        = $_POST['ddCatagory'];
	$price         = isset($_POST['txtPrice']) ? trim($_POST['txtPrice']) : 0;	
	$amount = isset($_POST['txtAmount']) ? trim($_POST['txtAmount']) : 0;	
	$short_detail  = isset($_POST['txtShortDetail']) ? trim($_POST['txtShortDetail']) : '';
	$full_detail        = isset($_POST['txtFullDetail']) ? trim($_POST['txtFullDetail']) : ''; 

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	//$errMsg .= checkUpload($_FILES["txtIcon"],".jpg;.gif;.bmp;.png",500*1024,0);
	//$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",500*1024,0);
	$is_update = 1;
	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update ".$tableConfig." set code='".$code."', name='".$name."', date_added=now(), catagory='".$catagory."', price='".$price."', amount='".$amount."', short_detail='".$short_detail."', full_detail='".$full_detail."' where id='".$oldid."'";
		}else{
			$sql = "insert into ".$tableConfig." (code, name, catagory, price, amount, short_detail, full_detail, date_added) values ('".$code."', '".$name."', '".$catagory."', '".$price."', '".$amount."', '".$short_detail."', '".$full_detail."', now())";
			$is_update = 0;
		}
		if (mysql_query($sql,$conn)){
			if($is_update == 0) {
				if(empty($_POST['id'])) $oldid = mysql_insert_id();
				$r = getRecord($tableConfig,"id=".$oldid);

				$sqlUpdateField = "";
				if ($_POST['chkClearImg']==''){
					$extsmall=getFileExtention($_FILES['txtIcon']['name']);
					if (makeUpload($_FILES['txtIcon'],"$path/".$actConfig."_sIcon".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sIcon".$oldid.$extsmall, 0777);
						$sqlUpdateField = "icon='$pathdb/".$actConfig."_sIcon".$oldid.$extsmall."'";
					} else{
						$errMsg = "Không thể cập nhật anh !";
					}
				}else{
					if(file_exists('../'.$r['icon'])) @unlink('../'.$r['icon']);
					$sqlUpdateField = " icon='' ";
				}
				if($sqlUpdateField!='')	{
					$sqlUpdate = "update ".$tableConfig." set $sqlUpdateField where id='".$oldid."'";
					mysql_query($sqlUpdate,$conn);
				}
				// image 1 upload
				if ($_POST['chkClearImg1']==''){
					$extsmall=getFileExtention($_FILES['txtImg1']['name']);
					if (makeUpload($_FILES['txtImg1'],"$path/".$actConfig."_sImg1_".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sImg1_".$oldid.$extsmall, 0777);
						$sqlUpdateField = " image1='$pathdb/".$actConfig."_sImg1_".$oldid.$extsmall."' ";
					}
				}else{
					if(file_exists('../'.$r['image1'])) @unlink('../'.$r['image1']);
					$sqlUpdateField = " image1='' ";
				}
				// image 2 upload
				if ($_POST['chkClearImg2']==''){
					$extsmall=getFileExtention($_FILES['txtImg2']['name']);
					if (makeUpload($_FILES['txtImg2'],"$path/".$actConfig."_sImg2_".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sImg2_".$oldid.$extsmall, 0777);
						$sqlUpdateField = $sqlUpdateField.", image2='$pathdb/".$actConfig."_sImg2_".$oldid.$extsmall."' ";
					}
				}else{
					if(file_exists('../'.$r['image2'])) @unlink('../'.$r['image2']);
					$sqlUpdateField = $sqlUpdateField.", image2='' ";
				}
				// image 3 upload
				if ($_POST['chkClearImg3']==''){
					$extsmall=getFileExtention($_FILES['txtImg3']['name']);
					if (makeUpload($_FILES['txtImg3'],"$path/".$actConfig."_sImg3_".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sImg3_".$oldid.$extsmall, 0777);
						$sqlUpdateField = $sqlUpdateField.", image3='$pathdb/".$actConfig."_sImg3_".$oldid.$extsmall."' ";
					}
				}else{
					if(file_exists('../'.$r['image3'])) @unlink('../'.$r['image3']);
					$sqlUpdateField = $sqlUpdateField.", image3='' ";
				}
				// image 4 upload
				if ($_POST['chkClearImg4']==''){
					$extsmall=getFileExtention($_FILES['txtImg4']['name']);
					if (makeUpload($_FILES['txtImg4'],"$path/".$actConfig."_sImg4_".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sImg4_".$oldid.$extsmall, 0777);
						$sqlUpdateField = $sqlUpdateField.", image4='$pathdb/".$actConfig."_sImg4_".$oldid.$extsmall."' ";
					}
				}else{
					if(file_exists('../'.$r['image4'])) @unlink('../'.$r['image4']);
					$sqlUpdateField = $sqlUpdateField.", image4='' ";
				}
				// image 5 upload
				if ($_POST['chkClearImg5']==''){
					$extsmall=getFileExtention($_FILES['txtImg5']['name']);
					if (makeUpload($_FILES['txtImg5'],"$path/".$actConfig."_sImg5_".$oldid.$extsmall)){
						@chmod("$path/".$actConfig."_sImg5_".$oldid.$extsmall, 0777);
						$sqlUpdateField = $sqlUpdateField.", image5='$pathdb/".$actConfig."_sImg5_".$oldid.$extsmall."' ";
					}
				}else{
					if(file_exists('../'.$r['image5'])) @unlink('../'.$r['image5']);
					$sqlUpdateField = $sqlUpdateField.", image5='' ";
				}
				// --------------------- UPDATE
				if($sqlUpdateField!='')	{
					$sqlUpdate = "update ".$tableConfig." set $sqlUpdateField where id='".$oldid."'";
					mysql_query($sqlUpdate,$conn);
				}
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	} else{
			$errMsg = "Không thể cập nhật !";
	}
	if ($errMsg == '') echo '<script>window.location="./?act='.$actConfig.'&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from ".$tableConfig." where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$catagory        = $row['catagory'];
			$icon         = $row['icon'];
			$image1          = $row['image1'];
			$image2        = $row['image2'];
			$image3    = $row['image3'];
			$image4 = $row['image4'];
			$image5         = $row['image5'];
			$price       = $row['price'];
			$amount   = $row['amount'];
			$short_detail  = $row['short_detail'];
			$full_detail        = $row['full_detail'];
		}
	}
}
?>

<form method="post" name="frmForm" enctype="multipart/form-data" action="./">
<input type="hidden" name="act" value="<?php echo $actConfig?>_m">
<input type="hidden" name="id" value="<?php echo $_REQUEST['id']?>">
<input type="hidden" name="page" value="<?php echo $_REQUEST['page']?>">

<table border="1" cellpadding="0" cellspacing="0" bordercolor="#0069A8" width="100%">
	<tr>
    	<td>
   		<table border="0" cellpadding="2" bordercolor="#111111" width="100%" cellspacing="0">
			<tr><td height="10"></td></tr>
			<tr>
				<td colspan="3" align="center">
					<table width="100%">
						<?php if($icon!=''){?>
						<tr>

								<td width="15%"></td>

							<td width="40%" align="center" class="smallfont">
<?php if ($icon!=''){ echo '<img border="0" src="../'.$icon.'" width="100"><br><br>Hình nhỏ';}?>								</td>

								<td width="15%"></td>
					  </tr>

							<?php }else{echo '<tr><td colspan="3" class="smallfont" align="center">Chưa có hình ảnh</td></tr>';}?>

							<tr><td colspan="4" height="10"></td></tr>

							<tr><td colspan="4" height="1" bgcolor="#999999"></td></tr>

							<tr><td colspan="4" height="10"></td></tr>
				  </table>					</td>
		  </tr> 		  		     						
				<tr>
					<td width="15%" class="smallfont" align="right">Tên sản phẩm</td>
					<td width="1%" class="smallfont" align="center"><font color="#FF0000">*</font></td>
					<td width="83%" class="smallfont">
						<input value="<?php echo $name?>" type="text" name="txtName" class="textbox" size="34">	</td>
				</tr>
				<tr>
					<td width="15%" class="smallfont" align="right">Mã sản phẩm</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input value="<?php echo $code?>" type="text" name="txtCode" class="textbox" size="34">	</td>
				</tr>
				<tr>
					<td width="15%" class="smallfont" align="right">Giá</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input value="<?php echo $price?>" type="text" name="txtPrice" class="textbox" size="34">&nbsp;<font color="#FF0000"><b><?php echo "VNĐ"?></b></font>				</td>
				</tr>
				<tr>
        			<td width="15%" class="smallfont" align="right">So lượng</td>
        			<td width="1%" class="smallfont" align="center"></td>
        			<td width="83%" class="smallfont">
						<input value="<?php echo $amount?>" type="text" name="txtAmount" class="textbox" size="34">					</td>
      			</tr>
			<tr><td height="10px"></td></tr>					
			<!-- Hinh anh -->	
				<tr>
					<td width="15%" class="smallfont" align="right">Hình nhỏ</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtIcon" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	</td>
				</tr><!-- image 1 --><tr><td height="10px"></td></tr>
				<tr>
					<td width="15%" class="smallfont" align="right">Hình 1</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtImg1" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg1" value="on"> Xóa bỏ hình ảnh	</td>
				</tr>
				<tr><!-- image 2 -->
					<td width="15%" class="smallfont" align="right">Hình 2</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtImg2" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg2" value="on"> Xóa bỏ hình ảnh	</td>
				</tr>
				<tr><!-- image 3 -->
					<td width="15%" class="smallfont" align="right">Hình 3</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtImg3" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg3" value="on"> Xóa bỏ hình ảnh	</td>
				</tr>
				<tr><!-- image 4 -->
					<td width="15%" class="smallfont" align="right">Hình 4</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtImg4" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg4" value="on"> Xóa bỏ hình ảnh</td>
				</tr>
				<tr><!-- image 5 -->
					<td width="15%" class="smallfont" align="right">Hình 5</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<input type="file" name="txtImg5" class="textbox" size="34">
						<input type="checkbox" name="chkClearImg5" value="on"> Xóa bỏ hình ảnh</td>
				</tr>
			<!-- het Hinh anh -->
				<tr>
					<td width="15%" class="smallfont" align="right">Thông tin ngan gon</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">						 
						<textarea name="txtShortDetail" cols="80" rows="10" id="txtShortDetail"><?php echo $short_detail?></textarea>					 </td>
				</tr>	
				<tr>
					<td width="15%" class="smallfont" align="right">Thông tin chi tiet</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">						 
						<textarea name="txtFullDetail" cols="80" rows="10" id="txtFullDetail"><?php echo $full_detail?></textarea>					 </td>
				</tr>				
				<tr><td height="10px"></td></tr>																			
				<tr>
					<td width="15%" class="smallfont" align="right">Thuộc danh mục</td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont">
						<?php echo comboCategory('ddCatagory',zgetArray('tbl_product_category'),'smallfont',$catagory,0)?>					</td>
				</tr>

				<tr>
					<td width="15%" class="smallfont"></td>
					<td width="1%" class="smallfont" align="center"></td>
					<td width="83%" class="smallfont"><input type="submit" name="btnSave" value="Cập nhật" class="button" onclick="return btnSave_onclick()" />

				    <input type="reset" class="button" value="Nhập lại">					</td>
				</tr>
		  </table>
		</td>
	</tr>
</table>
</form>

<?php if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>
