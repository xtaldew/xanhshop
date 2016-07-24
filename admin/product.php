<?php // Config
$tableCategoryConfig = 'tbl_product_category';
$tableConfig         = 'tbl_product';
$actConfig           = 'product';
$parentWhereConfig   = 'parent<>0';
?>

<?php $errMsg =''?>
<?php switch ($_GET['action']){
	case 'del' :
		$id = $_GET['id'];
		$r = getRecord($tableConfig ,"id=".$id);
		@$result = mysql_query('delete from '.$tableConfig.' where id="'.$id.'"',$conn);
		if ($result){
			if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
			if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
			mysql_query("delete from product_new where product_id='".$id."'",$conn);
			mysql_query("delete from product_special where product_id='".$id."'",$conn);
			
			$errMsg = 'Đã xóa thành công.';
		}else $errMsg = 'Không thể xóa dữ liệu !';
		break;
}

if (isset($_POST['btnDel'])){
	$cntDel=0;
	$cntNotDel=0;
	if($_POST['chk']!=''){
		foreach ($_POST['chk'] as $id){
			$r = getRecord($tableConfig ,"id=".$id);
			@$result = mysql_query('delete from '.$tableConfig.' where id="'.$id.'"',$conn);
			if ($result){
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				mysql_query("delete from product_new where product_id='".$id."'",$conn);
				mysql_query("delete from product_special where product_id='".$id."'",$conn);
				$cntDel++;
			}else{
				$cntNotDel++;
			}
		}
		$errMsg = 'Đã xóa '.$cntDel.' phần tử.<br><br>';
		$errMsg .= $cntNotDel>0 ? 'Không thể xóa '.$cntNotDel.' phần tử.<br>' : '';
	}else{
		$errMsg = 'Hãy chọn trước khi xóa !';
	}
}

/*Sản phẩm mới*/
if (isset($_POST['btnNew'])) {
	$cnt=0;
	if($_POST['chk']!=''){
		foreach ($_POST['chk'] as $id){
			$pro = getRecord($tableConfig, 'id='.$id);
			if ($pro){
				if (countRecord("tbl_product_new","product_id=".$pro['id']) <= 0){
					$result = mysql_query("insert into tbl_product_new (product_id,date_added,last_modified,lang) values ('".$pro['id']."',now(),now(),'".$pro['lang']."')",$conn);
					if ($result){$cnt++;}
				}
			}
		}
		$errMsg = 'Ðã Cập nhật <span style="font-family:Tahoma; color:#000000; font-size:12px; font-weight:600">'.$cnt.'</span> phần tử.';
	}else{
		$errMsg = 'Hãy chọn sản phẩm mới!';
	}
}


/*Sản phẩm đặc trưng*/
if (isset($_POST['btnSpecial'])) {
	$cnt=0;
	if($_POST['chk']!=''){
		foreach ($_POST['chk'] as $id){
			$pro = getRecord($tableConfig, 'id='.$id);
			if ($pro){
				if (countRecord("tbl_product_special","product_id=".$pro['id']) <= 0){
					$result = mysql_query("insert into tbl_product_special (product_id,name) values ('".$pro['id']."','".$pro['name']."')",$conn);
					if ($result){$cnt++;}
				}
			}
		}
		$errMsg = 'Ðã Cập nhật <span style="font-family:Tahoma; color:#000000; font-size:12px; font-weight:600">'.$cnt.'</span> phần tử.';
	}else{
		$errMsg = 'Hãy chọn sản phẩm đặc trưng!';
	}
}

$page = $_GET['page'];
$p=0;
if ($page!='') $p=$page;
$where='1=1';
if ($_REQUEST['cat']!='') $where='parent='.$_REQUEST['cat']?>
<form method="POST" action="./" name="frmForm" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page?>">
<input type="hidden" name="act" value="<?php echo $actConfig?>">
<?php $pageindex = createPage(countRecord($tableConfig,$where),'./?act='.$actConfig.'&cat='.$_REQUEST['cat'].'&page=',$MAXPAGE,$page)?>

<?php if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>

<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td height="30" class="smallfont">Trang : <?php echo $pageindex?></td>
		<td align="right" class="smallfont">
			<?php echo comboCategory('ddCat',getArrayCategoryChild($tableCategoryConfig),'smallfont',$_REQUEST['cat'],1)?>
			<input type="button" value="Chuyển" class="button" 
				onClick="window.location='./?act=<?php echo $actConfig ?>&cat='+ddCat.value">
		</td>
	</tr>
</table>

<table border="1" cellpadding="2" bordercolor="#C9C9C9" width="100%">
	<tr>
	  <th width="24" class="title"><input type="checkbox" name="chkall" onClick="chkallClick(this);"></th>
		<th class="title" colspan="2" rowspan></th>		
		<th width="27" class="title"><a class="title" href="<?php echo getLinkSort(1)?>">ID</a></th>
		<th width="48" class="title"><a class="title" href="<?php echo getLinkSort(2)?>">Mã sp</a></th>
		<th width="140" class="title"><a class="title" href="<?php echo getLinkSort(3)?>">Tên sản phẩm</a></th>		
		<th width="45" class="title"><a class="title" href="<?php echo getLinkSort(15)?>">Giá</a></th>
		<th width="98" class="title"><a class="title" href="<?php echo getLinkSort(4)?>">Thuộc danh mục</a></th>				
		<th width="52" class="title"><a class="title" href="<?php echo getLinkSort(6)?>">Chi tiết</a></th>
		<th width="45" class="title"><a class="title" href="<?php echo getLinkSort(8)?>">Hình nhỏ</a></th>
		<th width="45" class="title"><a class="title" href="<?php echo getLinkSort(9)?>">Hình lớn</a></th>
		<th width="62" class="title"><a class="title" href="<?php echo getLinkSort(10)?>">Thứ tự</a></th>
		<th width="56" class="title"><a class="title" href="<?php echo getLinkSort(11)?>">Hiển thị</a></th>
		<th width="111" class="title"><a class="title" href="<?php echo getLinkSort(12)?>">Ngày tạo lập</a></th>
		<th width="112" class="title"><a class="title" href="<?php echo getLinkSort(13)?>">Lần hiệu chỉnh trước</a></th>
		<th width="53" class="title"><a class="title" href="<?php echo getLinkSort(14)?>">Ngôn ngữ</a></th>
	</tr>
  
<?php $sortby = 'order by date_added';
if ($_REQUEST['sortby']!='') $sortby='order by '.(int)$_REQUEST['sortby'];
$direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?'desc':'');

$sql="select * from $tableConfig where 1 limit ".($p*$MAXPAGE).",".$MAXPAGE;
$result=mysql_query($sql,$conn);
$i=0;
while($row=mysql_fetch_array($result)){
	$parent = getRecord($tableCategoryConfig,'id = '.$row['catagory']);
	$color = $i++%2 ? '#d5d5d5' : '#e5e5e5'?>
  
	<tr>
		<td align="center" bgcolor="<?php echo $color?>" class="smallfont">
		<input type="checkbox" name="chk[]" value="<?php echo $row['id']?>"></td>
		<td width="28" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a href="./?act=<?php echo $actConfig?>_m&cat=<?php echo $_REQUEST['cat']?>&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>">Sửa</a>		</td>
		<td width="29" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a 
				onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" 
				href="./?act=<?php echo $actConfig?>&action=del&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>"
			>Xóa</a>		</td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['id']?></td>	
		<td bgcolor="<?php echo $color?>" class="smallfont" align="left"><?php echo $row['code']?></td>			
		<td bgcolor="<?php echo $color?>" class="smallfont"><?php echo $row['name']?></td>		
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center">
		<font color="#FF0000"><?php echo number_format($row['price'])?></font></td>		
		<td bgcolor="<?php echo $color?>" class="smallfont"><?php echo $parent['name']?></td>				
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['short_dstail']!=''?'...':'&nbsp;'?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['icon']!=''?'...':'&nbsp;'?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['image_large']!=''?'...':'&nbsp;'?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['sort']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center">
			<input type="checkbox" disabled <?php echo $row['status']>0?'checked':''?>>
		</td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['dateAdd']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['dateModify']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['lang']?></td>
	</tr>
<?php }
?>
</table>

<table width="100%">
	<tr>
		<td width="30%">
<input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
<input type="button" value="Thêm mới" name="btnNew" onClick="window.location='./?act=<?php echo $actConfig?>_m&page=<?php echo $_REQUEST['page']?>&cat=<?php echo $_REQUEST['cat']?>'" class="button">
		</td>
		
	  <td align="right">
			<input type="submit" value="Sản phẩm mới" name="btnNew" class="button">
			<input type="submit" value="Sản phẩm đặc trưng" name="btnSpecial" class="button">   </td>
	</tr>
</table>

</form>
<script language="JavaScript">
function chkallClick(o) {
  	var form = document.frmForm;
	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
			form.elements[i].checked = document.frmForm.chkall.checked;
		}
	}
}
</script>
<?php if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>

<table width="100%">
	<tr><td height="10"></td></tr>
	<tr><td class="smallfont"><?php echo 'Tổng số hàng : <b>'.countRecord($tableConfig).'</b>'?></td></tr>
</table>
