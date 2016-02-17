<?php
include_once("connect.php");
$action = $_GET['action'];
$id = (int)$_GET['id'];
switch($action){
	case 'add':
		addform();
		break;
	case 'edit':
		editform($id);
		break;
}

function addform(){
$date = $_GET['date'];
$enddate = $_GET['end'];
if($date==$enddate) $enddate='';
if(empty($enddate)){
	// $display = 'style="display:none"';
	$enddate = $date;
	$chk = '';
}else{
	$display = 'style=""';
	$chk = 'checked';
}
$enddate = empty($_GET['end'])?$date:$_GET['end'];
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<div class="fancy">
	<h3>New Booking</h3>
    <form id="add_form" action="do.php?action=add" method="post">
    <!-- Note here !!!-->
    <p>Booking Log：<input type="text" class="input" name="event" id="event" style="width:320px" placeholder="Booking Description"></p>
    <p>Start Time：<input type="text" class="input datepicker" name="startdate" id="startdate" value="<?php echo $date;?>" readonly>
    <span id="sel_start" ><select name="s_hour">
        <option value="08" selected>08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>

    </select>:
    <select name="s_minute">
    	<option value="00" selected>00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p id="p_endtime" <?php echo $display;?>>End Time：<input type="text" class="input datepicker" name="enddate" id="enddate" value="<?php echo $enddate;?>" readonly>
    <span id="sel_end" ><select name="e_hour">

        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12" selected>12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
    </select>:
    <select name="e_minute">
    	<option value="00" selected>00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <div class="sub_btn"><input type="submit" class="btn btn_ok" value="Confirm"> <input type="button" class="btn btn_cancel" value="Cancel" onClick="$.fancybox.close()"></div>
    </form>
</div>
<?php }

function editform($id){
	$query = mysql_query("select * from calendar where id='$id'");
	$row = mysql_fetch_array($query);
	if($row){
		$id = $row['id'];
		$title = $row['title'];
		$starttime = $row['starttime'];
		$start_d = date("Y-m-d",$starttime);
		$start_h = date("H",$starttime);
		$start_m = date("i",$starttime);
		
		$endtime = $row['endtime'];
		if($endtime==0){
			$end_d = $startdate;
			$end_chk = '';
			$end_display = "style='display:none'";
		}else{
			$end_d = date("Y-m-d",$endtime);
			$end_h = date("H",$endtime);
			$end_m = date("i",$endtime);
			$end_chk = "checked";
			$end_display = "style=''";
		}
		
		$allday = $row['allday'];
		if($allday==1){
			$display = "style='display:none'";
			$allday_chk = "checked";
		}else{
			$display = "style=''";
			$allday_chk = '';
		}
	}
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<div class="fancy">
	<h3>Edit Booking</h3>
    <form id="add_form" action="do.php?action=edit" method="post">
    <input type="hidden" name="id" id="eventid" value="<?php echo $id;?>">
    <p>Booking Description：<input type="text" class="input" name="event" id="event" style="width:320px" placeholder="Description" value="<?php echo $title;?>"></p>
    <p>Start Time：<input type="text" class="input datepicker" name="startdate" id="startdate" value="<?php echo $start_d;?>" readonly>
    <span id="sel_start" <?php echo $display;?>><select name="s_hour">
    	<option value="<?php echo $start_h;?>" selected><?php echo $start_h;?></option>

        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>

    </select>:
    <select name="s_minute">
    	<option value="<?php echo $start_m;?>" selected><?php echo $start_m;?></option>
    	<option value="00">00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p id="p_endtime" <?php echo $end_display;?>>End Time：<input type="text" class="input datepicker" name="enddate" id="enddate" value="<?php echo $end_d;?>" readonly>
    <span id="sel_end"  <?php echo $display;?>><select name="e_hour">
    	<option value="<?php echo $end_h;?>" selected><?php echo $end_h;?></option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
    </select>:
    <select name="e_minute">
    	<option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
    	<option value="00">00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <div class="sub_btn"><span class="del"><input type="button" class="btn btn_del" id="del_event" value="Delete"></span><input type="submit" class="btn btn_ok" value="Confirm"> <input type="button" class="btn btn_cancel" value="Cancel" onClick="$.fancybox.close()"></div>
    </form>
</div>
<?php }?>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".datepicker").datepicker({minDate: -3,maxDate: 3});
	// $("#isallday").click(function(){
	// 	if($("#sel_start").css("display")=="none"){
	// 		$("#sel_start,#sel_end").show();
	// 	}else{
	// 		$("#sel_start,#sel_end").hide();
	// 	}
	// });
	
	// $("#isend").click(function(){
	// 	if($("#p_endtime").css("display")=="none"){
	// 		$("#p_endtime").show();
	// 	}else{
	// 		$("#p_endtime").hide();
	// 	}
	// 	$.fancybox.resize();//调整高度自适应
	// });
	
	//提交表单
	$('#add_form').ajaxForm({
		beforeSubmit: showRequest, //表单验证
        success: showResponse //成功返回
    }); 
	
	//删除事件
	$("#del_event").click(function(){
		if(confirm("Are you sure you want to delete it？")){
			var eventid = $("#eventid").val();
			$.post("do.php?action=del",{id:eventid},function(msg){
				if(msg==1){//删除成功
					$.fancybox.close();
					$('#calendar').fullCalendar('refetchEvents'); //重新获取所有事件数据
				}else{
					alert(msg);	
				}
			});
		}
	});
});

function showRequest(){
	var events = $("#event").val();
	if(events==''){
		alert("Please input the event description！");
		$("#event").focus();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form){
	if(statusText=="success"){	
		if(responseText==1){
			$.fancybox.close();
			$('#calendar').fullCalendar('refetchEvents'); //重新获取所有事件数据
		}else{
			alert(responseText);
		}
	}else{
		alert(statusText);
	}
}
</script>