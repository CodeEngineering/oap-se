
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step 6</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Summary<strong><?=$connection->connection_name?></strong></h3>
				<?php echo form_open('mapping/step07',array('name'=>'step04','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
				<?= form_hidden('form', 'step06');?>
				<?= form_hidden('id', $connection->id);?>
				<?=form_input(array('name' => 'connectionid', 'type'=>'hidden', 'id' =>'connectionid','value'=>$connection->id));?>
				<?=form_input(array('name' => 'connection_name', 'type'=>'hidden', 'id' =>'connection_name','value'=>$connection->connection_name));?>
				<?=form_input(array('name' => 'schedule', 'type'=>'hidden', 'id' =>'schedule','value'=>$connection->schedule));?>
          </div>
		  
		  <table class='table'>
		  <tr>
			<td>Connection Name</td>
			<td><?=$connection->connection_name;?></td>
		  </tr>
		  <tr>
			<td>Description</td>
			<td><?=$connection->description;?></td>
		  </tr>
		  
		  <tr>
			<td>Data Source</td>
			<td><?=$connection->api_source;?></td>
		  </tr>
		  <tr>
			<td>Target API</td>
			<td><?=$connection->api_target;?></td>
		  </tr>
		  <tr>
			<td>Schedule</td>
			<td>
			<table class='table'>
			<tr>
				
				<th>Day</th>
				<th>From</th>
				<th>To</th>
				<th>Interval(hrs)</th>
				
			</tr>
			<?php
		
				$days=array('mon','tue','wed','thu','fri','sat','sun');
				$day=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
				$interval=array(
						0.5=>0.5,
						1.0=>1.0,
						2.0=>2.0,
						3.0=>3.0,
						4.0=>4.0,
						5.0=>5.0,
						6.0=>6.0,
						12.0=>12.0,
						22.0=>22.0,
				);
				for($i=0;$i<=6;$i++)
				{
					if ($scheduler->{$days[$i]."-enabled"}==1)
					{
						echo "<tr><td>$day[$i]</td><td>".date('H:i',$scheduler->{$days[$i]."-start"})."</td><td>".date('H:i',$scheduler->{$days[$i]."-end"})."</td><td>".$interval[$scheduler->sync_interval]."</td></tr>";
					}
				}
			?>
			</table>
			</td>
		  </tr>
		  
		  </table>
          <div class="span2">

<div class="form-group">
    <div class="col-sm-5" style='text-align:right'>
  				<button type="submit" class="btn btn-primary">
				<span class="glyphicon glyphicon-arrow-right"></span> Next
				</button>   
    </div>
  </div>  
</form>  
		
		
		

			
          </div>
        </div>
      </div>
   
<script type="text/javascript">
$(document).ready(function() {
		
	$('select[name^="alldays"]').change(function(){
		$('input[name^="enabled"]').prop('checked',true);
				switch ($(this).val())
				{
					case '0':
					{
						$('input[name^="enabled[0]"]').prop('checked',false);
						$('input[name^="enabled[6]"]').prop('checked',false);
						break;
						
					}
					case '1':
					{
						break;
					}
				}
		
	});
	$('select[name^="10pm"]').change(function(){
	
		$('input[name^="enabled"]').prop('checked',false);
			switch($(this).val())
			{
				case '0'://everyday
				{
					$('input[name^="enabled"]').prop('checked',true);
					break;
				}
				case '1'://monday
				{
					$('input[name^="enabled[1]"]').prop('checked',true);
					break;
				}
				case '2'://wednesday
				{
					$('input[name^="enabled[3]"]').prop('checked',true);
					break;
				}
				case '3'://Friday
				{
					$('input[name^="enabled[5]"]').prop('checked',true);
					break;
				}
				case '4'://MWF
				{
					$('input[name^="enabled[1]"]').prop('checked',true);
					$('input[name^="enabled[3]"]').prop('checked',true);
					$('input[name^="enabled[5]"]').prop('checked',true);					
					break;
				}

				
			}
	
	});
$('input[name="weekdays"]:radio ').change(function (){

	$('select[name^="10pm"]').attr('disabled',true);
	$('select[name^="alldays"]').attr('disabled',true);
	$('select[name^='+$(this).val()+']').attr('disabled',false).change();

/*
	switch ($(this).val())
	{
		case '10pm':
		{
			$('input[name^="start"]').val("22:00");
			$('input[name^="end"]').val("00:00");
			$('input[name^="enabled"]').prop('checked',false);
			switch($('select[name^="10pm"]').val())
			{
				case '0'://everyday
				{
					$('input[name^="enabled"]').prop('checked',true);
					break;
				}
				case '1'://monday
				{
					$('input[name^="enabled[1]"]').prop('checked',false);
					break;
				}
				case '2'://wednesday
				{
					$('input[name^="enabled[3]"]').prop('checked',false);
					break;
				}
				case '3'://Friday
				{
					$('input[name^="enabled[5]"]').prop('checked',false);
					break;
				}
				case '4'://MWF
				{
					$('input[name^="enabled[1]"]').prop('checked',false);
					$('input[name^="enabled[3]"]').prop('checked',false);
					$('input[name^="enabled[5]"]').prop('checked',false);					
					break;
				}

				
			}
			break;
		}
		case 'alldays':
		{
			$('input[name^="start"]').val("00:00");
			$('input[name^="end"]').val("24:00");
			$('input[name^="enabled"]').prop('checked',true);
			switch ($('select[name^="alldays"]').val())
			{
				case '0':
				{
					$('input[name^="enabled[0]"]').attr('checked',false);
					$('input[name^="enabled[6]"]').attr('checked',false);
					break;
					
				}
				case '1':
				{
					break;
				}
			}
			break;
		}
	}

	*/
	});
$('input[name="weekdays"]:radio ').change();

});
/*
	$(document).ready(function() {     
	   var view="week";          
	   
		var DATA_FEED_URL = "/wdcalendar/";
		var op = {
			view               : view,
			theme              :3,
			showday            : new Date(),
			EditCmdhandler     :Edit,
			DeleteCmdhandler   :Delete,
			ViewCmdhandler     :View,    
			onWeekOrMonthToDay :wtd,
			onBeforeRequestData: cal_beforerequest,
			onAfterRequestData : cal_afterrequest,
			onRequestDataError : cal_onerror, 
			autoload           :true,
			url                : DATA_FEED_URL + "listing",  
			quickAddUrl        : DATA_FEED_URL + "add", 
			quickUpdateUrl     : DATA_FEED_URL + "update",
			quickDeleteUrl     : DATA_FEED_URL + "remove",
			connectionid       : $('#connectionid').val(),
			extParam		   :[{ name: "connectionid", value: $('#connectionid').val() }]
			
		};
		var $dv = $("#calhead");
		var _MH = document.documentElement.clientHeight;
		var dvH = $dv.height() + 2;
		op.height = _MH - dvH;
		op.eventItems =[];

		var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
		$("#caltoolbar").noSelect();
		
		$("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
		onReturn:function(r){                          
						var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
						if (p && p.datestrshow) {
							$("#txtdatetimeshow").text(p.datestrshow);
						}
				 } 
		});
		function cal_beforerequest(type)
		{
			var t="Loading data...";
			switch(type)
			{
				case 1:
					t="Loading data...";
					break;
				case 2:                      
				case 3:  
				case 4:    
					t="The request is being processed ...";                                   
					break;
			}
			$("#errorpannel").hide();
			$("#loadingpannel").html(t).show();    
		}
		function cal_afterrequest(type)
		{
			switch(type)
			{
				case 1:
					$("#loadingpannel").hide();
					break;
				case 2:
				case 3:
				case 4:
					$("#loadingpannel").html("Success!");
					window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
				break;
			}              
		   
		}
		function cal_onerror(type,data)
		{
			$("#errorpannel").show();
		}
		function Edit(data)
		{
		   var eurl="/wdcalendar/edit/?id={0}&start={2}&end={3}&isallday={4}&title={1}&connectionid="+$('#connectionid').val();   
		   //var eurl="/wdcalendar/edit/{0}/{2}/{3}/{4}/{1}";   
			if(data)
			{
				var url = StrFormat(eurl,data);
				OpenModelWindow(url,{ width: 600, height: 400, caption:"Manage  The Calendar",onclose:function(){
				   $("#gridcontainer").reload();
				}});
			}
		}    
		function View(data)
		{
			var str = "";
			$.each(data, function(i, item){
				str += "[" + i + "]: " + item + "\n";
			});
			alert(str);               
		}    
		function Delete(data,callback)
		{           
			
			$.alerts.okButton="Ok";  
			$.alerts.cancelButton="Cancel";  
			hiConfirm("Are You Sure to Delete this Event", 'Confirm',function(r){ r && callback(0);});           
		}
		function wtd(p)
		{
		   if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}
			$("#caltoolbar div.fcurrent").each(function() {
				$(this).removeClass("fcurrent");
			})
			$("#showdaybtn").addClass("fcurrent");
		}
		//to show day view
		$("#showdaybtn").click(function(e) {
			//document.location.href="#day";
			$("#caltoolbar div.fcurrent").each(function() {
				$(this).removeClass("fcurrent");
			})
			$(this).addClass("fcurrent");
			var p = $("#gridcontainer").swtichView("day").BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}
		});
		//to show week view
		$("#showweekbtn").click(function(e) {
			//document.location.href="#week";
			$("#caltoolbar div.fcurrent").each(function() {
				$(this).removeClass("fcurrent");
			})
			$(this).addClass("fcurrent");
			var p = $("#gridcontainer").swtichView("week").BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}

		});
		//to show month view
		$("#showmonthbtn").click(function(e) {
			//document.location.href="#month";
			$("#caltoolbar div.fcurrent").each(function() {
				$(this).removeClass("fcurrent");
			})
			$(this).addClass("fcurrent");
			var p = $("#gridcontainer").swtichView("month").BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}
		});
		
		$("#showreflashbtn").click(function(e){
			$("#gridcontainer").reload();
		});
		
		//Add a new event
		$("#faddbtn").click(function(e) {
			//var url ="edit.php";
			var url ="/wdcalendar/edit/?connectionid="+$('#connectionid').val();
			OpenModelWindow(url,{ width: 500, height: 400, caption: "Create New Calendar"});
		});
		//go to today
		$("#showtodaybtn").click(function(e) {
			var p = $("#gridcontainer").gotoDate().BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}


		});
		//previous date range
		$("#sfprevbtn").click(function(e) {
			var p = $("#gridcontainer").previousRange().BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}

		});
		//next date range
		$("#sfnextbtn").click(function(e) {
			var p = $("#gridcontainer").nextRange().BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}
		});
		
	});
*/

	</script>  
