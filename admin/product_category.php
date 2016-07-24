<?php $errMsg =''?>
<?php switch ($_GET['action']){
	case 'del' :
		$id = $_GET['id'];
		$r = getRecord("tbl_product_category","id=".$id);
		$resultParent = mysql_query("select id from tbl_product_category where parent='".$id."'",$conn);
		if (mysql_num_rows($resultParent) <= 0){
			@$result = mysql_query("delete from tbl_product_category where id='".$id."'",$conn);
			if ($result){
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				$errMsg = "ÄÃ£ xÃ³a thÃ nh cÃ´ng.";
			}else $errMsg = "KhÃ´ng thá»ƒ xÃ³a dá»¯ liá»‡u !";
		}else{
			$errMsg = "Äang cÃ³ danh má»¥c sá»­ dá»¥ng. Báº¡n khÃ´ng thá»ƒ xÃ³a !";	
		}
		break;
}

if (isset($_POST['btnDel'])){
	$cntDel=0;
	$cntNotDel=0;
	$cntParentExist=0;
	if($_POST['chk']!=''){
		foreach ($_POST['chk'] as $id){
			$r = getRecord("tbl_product_category","id=".$id);
			$resultParent = mysql_query("select id from tbl_product_category where parent='".$id."'",$conn);
			if (mysql_num_rows($resultParent) <= 0){
				@$result = mysql_query("delete from tbl_product_category where id='".$id."'",$conn);
				if ($result){
					if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
					if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
					$cntDel++;
				}else $cntNotDel++;
			}else{
				$cntParentExist++;
			}
		}
		$errMsg = "ÄÃ£ xÃ³a ".$cntDel." pháº§n tá»­.<br><br>";
		$errMsg .= $cntNotDel>0 ? "KhÃ´ng thá»ƒ xÃ³a ".$cntNotDel." pháº§n tá»­.<br>" : '';
		$errMsg .= $cntParentExist>0 ? "Äang cÃ³ danh má»¥c con sá»­ dá»¥ng ".$cntParentExist." pháº§n tá»­." : '';
	}else{
		$errMsg = "HÃ£y chá»n trÆ°á»›c khi xÃ³a !";
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
<?php $pageindex = createPage(countRecord("tbl_product_category",$where),"./?act=product_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>

<?php if ($_REQUEST['code']==1) $errMsg = 'Cáº­p nháº­t thÃ nh cÃ´ng.'?>

<table cellspacing="0" cellpadding="0" width="100%">
	
	<tr>
		<td class="smallfont">Trang : <?php echo $pageindex?></td>
		<td height="30" align="right" class="smallfont">
			<?php echo comboCategory('ddCat',getArrayCategory('tbl_product_category'),'smallfont',$_REQUEST['cat'],1)?>
			<input type="button" value="Chuyá»ƒn" class="button" onClick="window.location='./?act=product_category&cat='+ddCat.value">
		</td>
	</tr>
</table>

<table border="1" cellpadding="2" bordercolor="#C9C9C9" width="100%">
	<tr>
	  <th width="27" class="title"><input type="checkbox" name="chkall" onClick="chkallClick(this);"></th>
		<th class="title" colspan="2" nowrap></th>
		<th width="30" class="title"><a class="title" href="<?php echo getLinkSort(1)?>">ID</a></th>
		<th width="199" class="title"><a class="title" href="<?php echo getLinkSort(3)?>">TÃªn danh má»¥c</a></th>
		<!--th width="132" class="title"><a class="title" href="<?php echo getLinkSort(4)?>">Thuá»™c danh má»¥c</a></th-->		
		<th width="67" class="title"><a class="title" href="<?php echo getLinkSort(10)?>">Thá»© tá»± sáº¯p xáº¿p</a></th>
		<!--th width="67" class="title"><a class="title" href="<?php echo getLinkSort(11)?>">KhÃ´ng hiá»ƒn thá»‹</a></th>
		<th width="122" class="title"><a class="title" href="<?php echo getLinkSort(12)?>">NgÃ y táº¡o láº­p</a></th>
		<th width="124" class="title"><a class="title" href="<?php echo getLinkSort(13)?>">Láº§n hiá»‡u chá»‰nh trÆ°á»›c</a></th>
		<th width="55" class="title"><a class="title" href="<?php echo getLinkSort(14)?>">NgÃ´n ngá»¯</a></th-->
	</tr>
  
<?php 
//if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
//$direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
$sql="select * from tbl_product_category where 1 order by sort limit ".($p*$MAXPAGE).",".$MAXPAGE;
//$sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_product_category where id>4 and $where $sortby $direction limit ".($p*$MAXPAGE).",".$MAXPAGE;
$result=mysql_query($sql,$conn);
$i=0;
while($row=mysql_fetch_array($result)){
//	if($row['id']!=2 && $row['id']!=77)
//	{
//		$parent = getRecord('tbl_product_category','id = '.$row['parent']);
		$color = $i++%2 ? "#d5d5d5" : "#e5e5e5"?>

	<tr>
		<td align="center" bgcolor="<?php echo $color?>" class="smallfont">
		<input type="checkbox" name="chk[]" value="<?php echo $row['id']?>">
		</td>
		<td width="30" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a href="./?act=product_category_m&cat=<?php echo $_REQUEST['cat']?>&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>">Sá»­a</a>		</td>
		<td width="30" align="center" bgcolor="<?php echo $color?>" class="smallfont">
			<a 
				onClick="return confirm('Báº¡n cÃ³ cháº¯c cháº¯n muá»‘n xÃ³a ?');" 
				href="./?act=product_category&action=del&page=<?php echo $_REQUEST['page']?>&id=<?php echo $row['id']?>"
			>XÃ³a</a>	  </td>
		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['id']?></td>
		<td bgcolor="<?php echo $color?>" class="smallfont"><?php echo $row['name']?></td>
		<!--td bgcolor="<php echo $color?>" class="smallfont"><php echo $parent['name']?></td-->

		<td bgcolor="<?php echo $color?>" class="smallfont" align="center"><?php echo $row['sort']?></td>
		<!--td bgcolor="<php echo $color?>" class="smallfont" align="center">
			<input type="checkbox" disabled <php echo $row['status']>0?'checked':''?>>
		</td>
		<td bgcolor="<php echo $color?>" class="smallfont" align="center"><php echo $row['dateAdd']?></td>
		<td bgcolor="<php echo $color?>" class="smallfont" align="center"><php echo $row['dateModify']?></td>
		<td bgcolor="<php echo $color?>" class="smallfont" align="center"><php echo $row['lang']?></td-->
	</tr>
<?php }
?>
</table>
<input type="submit" value="XÃ³a chá»n" name="btnDel" onClick="return confirm('Báº¡n cÃ³ cháº¯c cháº¯n muá»‘n xÃ³a ?');" class="button">
<input type="button" value="ThÃªm má»›i" name="btnNew" onClick="window.location='./?act=product_category_m&page=<?php echo $_REQUEST['page']?>&cat=<?php echo $_REQUEST['cat']?>'" class="button">
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
	<tr><td class="smallfont"><?php echo 'Tá»•ng sá»‘ hÃ ng : <b>'.countRecord('tbl_product_category','').'</b>'?></td></tr>
</table>