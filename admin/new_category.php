<?php $errMsg =''?>
<?php switch ($_GET['action']){
	case 'del' :
		$id = $_GET['id'];
		$r = getRecord("tbl_new_category","id=".$id);
		$resultParent = mysql_query("select id from tbl_new_category where parent='".$id."'",$conn);
		if (mysql_num_rows($resultParent) <= 0){
			@$result = mysql_query("delete from tbl_new_category where id='".$id."'",$conn);
			if ($result){
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				$errMsg = "Đã xóa thành công.";
			}else $errMsg = "Không thể xóa dữ liệu !";
		}else{
			$errMsg = "Đang có danh mục sử dụng. Bạn không thể xóa !";	
		}
		break;
}

if (isset($_POST['btnDel'])){
	$cntDel=0;
	$cntNotDel=0;
	$cntParentExist=0;
	if($_POST['chk']!=''){
		foreach ($_POST['chk'] as $id){
			$r = getRecord("tbl_new_category","id=".$id);
			$resultParent = mysql_query("select id from tbl_new_category where parent='".$id."'",$conn);
			if (mysql_num_rows($resultParent) <= 0){
				@$result = mysql_query("delete from tbl_new_category where id='".$id."'",$conn);
				if ($result){
					if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
					if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
					$cntDel++;
				}else $cntNotDel++;
			}else{
				$cntParentExist++;
			}
		}
		$errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
		$errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
		$errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
	}else{
		$errMsg = "Hãy chọn trước khi xóa !";
	}
}

$page = $_GET["page"];
$p=0;
if ($page!='') $p=$page;
$where="1=1";
if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']?>
<form method="POST" action="./" name="frmForm" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page?>">
<input type="hidden" name="act" value="product_category">
<?php $pageindex = createPage(countRecord("tbl_new_category",$where),"./?act=product_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>

<?php if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>

<table cellspacing="0" cellpadding="0" width="100%">
	
	<tr>
		<td class="smallfont">Trang : <?php echo $pageindex?></td>
		<td height="30" align="right" class="smallfont">
			<?php echo comboCategory('ddCat',getArrayCategory('tbl_new_category'),'smallfont',$_REQUEST['cat'],1)?>
			<input type="button" value="Chuyển" class="button" onClick="window.location='./?act=product_category&cat='+ddCat.value">
		</td>
	</tr>
</table>

<table border="1" cellpadding="2" bordercolor="#C9C9C9" width="100%">
	<tr>
	  <th width="23" class="title"><input type="checkbox" name="chkall" onClick="chkallClick(this);"></th>
		<th class="title" colspan="2" nowrap></th>
		<th width="37" class="title"><a class="title" href="<?php echo getLinkSort(1)?>">ID</a></th>	
		<th width="238" class="title"><a class="title" href="<?php echo getLinkSort(3)?>">Tên danh mục</a></th>
		<th width="143" class="title"><a class="title" href="<?php echo getLinkSort(4)?>">Thuộc danh mục</a></th>	
		<th width="56" class="title"><a class="title" href="<?php echo getLinkSort(10)?>">Thứ tự sắp xếp</a></th>
		<th width="56" class="title"><a class="title" href="<?php echo getLinkSort(11)?>">Không hiển thị</a></th>
		<th width="101" class="title"><a class="title" href="<?php echo getLinkSort(12)?>">Ngày tạo lập</a></th>
		<th width="101" class="title"><a class="title" href="<?php echo getLinkSort(13)?>">Lần hiệu chỉnh trước</a></th>
		<th width="51" class="title"><a class="title" href="<?php echo getLinkSort(14)?>">Ngôn ngữ</a></th>
	</tr>
  
<?php $sortby="order by date_added";
if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
$direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");

$sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_new_category where id>4 and $where $sortby $direction limit ".($p*$MAXPAGE).",".$MAXPAGE;
$result=mysql_query($sql,$conn);
$i=0;
while($row=mysql_fetch_array($result)){
	$parent = getRecord('tbl_new_category','id = '.$row['parent']);
	$color = $i++%2 ? "#d5d5d5" : "#e5e5e5"?>

	<tr>
		<td align="center" bgcolor="<?php echo $color?>" class="smallfont">
		<input type="checkbox" name="chk[]" value="<?php echo $row['id']?>"></td>
		<td width="30" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a href="./?act=new_category_m&cat=<?php echo $_REQUEST['cat']?>&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>">Sửa</a>		</td>
		<td width="30" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a 
				onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" 
				href="./?act=product_category&action=del&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>"
			>Xóa</a>		</td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['id']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont"><?php echo $row['name']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont"><?php echo $parent['name']?></td>		
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
<input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
<input type="button" value="Thêm mới" name="btnNew" onClick="window.location='./?act=new_category_m&page=<?php echo $_REQUEST['page']?>&cat=<?php echo $_REQUEST['cat']?>'" class="button">
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
	<tr><td class="smallfont"><?php echo 'Tổng số hàng : <b>'.countRecord('tbl_new_category','id>4').'</b>'?></td></tr>
</table>