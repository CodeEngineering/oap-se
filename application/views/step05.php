
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step 5</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Schedule to excute <strong><?=$connection->connection_name?></strong></h3>
			<?php echo form_open('mapping/step06',array('name'=>'step04','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
				<?= form_hidden('form', 'step05');?>
				<?= form_hidden('id', $connection->id);?>
				<?=form_input(array('name' => 'connectionid', 'type'=>'hidden', 'id' =>'connectionid','value'=>$connection->id));?>
				<?=form_input(array('name' => 'connection_name', 'type'=>'hidden', 'id' =>'connection_name','value'=>$connection->connection_name));?>
				<?=form_input(array('name' => 'schedule', 'type'=>'hidden', 'id' =>'schedule','value'=>$connection->schedule));?>
          </div>
          <div class="span2">
<div class='row'>

<div class="panel panel-primary">
<div class="panel-heading">Daily Schedule</div>
 <div class="panel-body">		  
<div class="col-lg-4">
    <div class="input-group">
	
      <span class="input-group-addon">
		Run every 10PM EST? &nbsp;
        <input name='weekdays' class='weekdays' value='10pm' type="radio" placeholder='run every 10 pm EST' <?=$scheduler->weekdays_type=='10pm'?'checked':''?>>
		
      </span>
		<select name='10pm' class="form-control">
			<option <?$scheduler->days==0?'selected':''?> value='0'>Every Night</option>
			<option <?$scheduler->days==1?'selected':''?>  value='1'>Every Monday</option>
			<option <?$scheduler->days==2?'selected':''?>  value='2'>Every Wednesday</option>
			<option <?$scheduler->days==3?'selected':''?>  value='3'>Every Friday</option>
			<option <?$scheduler->days==4?'selected':''?>  value='4'>Every MWF</option>
		</select>

    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->


<div class="col-lg-4">
    <div class="input-group">
      <span class="input-group-addon">
	  Run on specifics day and time
        <input name='weekdays'  class='weekdays' type="radio" value='alldays' <?=$scheduler->weekdays_type=='alldays'?'checked':''?>>
      </span>
		<select name='alldays' class="form-control" >
		
			<option  <?$scheduler->days==0?'selected':''?> value='0'>On weekdays</option>
			<option  <?$scheduler->days==1?'selected':''?> value='1'>On weekdays and Weekends</option>
			<option  <?$scheduler->days==2?'selected':''?> value='2'>Custom</option>
		
		</select>

    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>
</div>
<div class="panel panel-primary">
<div class="panel-heading">Sync Interval</div>
<div class="panel-body">
<div class="col-lg-4">
    <div class="input-group">
      <span class="input-group-addon">
	  Run every (hours)
      </span>
		<select name='sync_interval' class="form-control">
			<option  <?=$scheduler->{'sync_interval'}=='0.5'?'selected':''?> value='0.5'>0.5</option>
			<option  <?=$scheduler->{'sync_interval'}=='1.0'?'selected':''?> value='1.0'>1.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='2.0'?'selected':''?> value='2.0'>2.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='3.0'?'selected':''?> value='3.0'>3.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='4.0'?'selected':''?> value='4.0'>4.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='5.0'?'selected':''?> value='5.0'>5.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='5.0'?'selected':''?> value='6.0'>6.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='12.0'?'selected':''?> value='12.0'>12.0</option>
			<option  <?=$scheduler->{'sync_interval'}=='24.0'?'selected':''?> value='24.0'>24.0</option>
		</select>

    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>
</div>
</div>
<div class='row'>
<div class="panel panel-primary">
<div class="panel-heading">Detail Schedule</div>
<div class="panel-body">		
<div class="col-md-7 col-md-offset-3">		  
<table class='table table-condensed table-striped'>
<thead>
	<tr>
		<th>Day</th>
		<th>Sun</th>
		<th>Mon</th>
		<th>Tue</th>
		<th>Wed</th>
		<th>Thu</th>
		<th>Fri</th>
		<th>Sat</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th>Enabled</th>
		<td>  
			<div class="checkbox">
				<label>
				  <input <?=$scheduler->{'sun-enabled'}==1?'checked':'' ?> name='enabled[0]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input <?=$scheduler->{'mon-enabled'}==1?'checked':'' ?>  name='enabled[1]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input <?=$scheduler->{'tue-enabled'}==1?'checked':'' ?>  name='enabled[2]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  <?=$scheduler->{'wed-enabled'}==1?'checked':'' ?> name='enabled[3]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  <?=$scheduler->{'thu-enabled'}==1?'checked':'' ?>  name='enabled[4]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  <?=$scheduler->{'fri-enabled'}==1?'checked':'' ?>  name='enabled[5]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  <?=$scheduler->{'sat-enabled'}==1?'checked':'' ?> name='enabled[6]' type="checkbox"> &nbsp;
				</label>
			</div>
		</td>

		
	</tr>
	<tr>
		<th> <label>Start</label></th>
		<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'sun-start'})?>' type="input" class="form-control" name="start[0]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'mon-start'})?>'  type="input" class="form-control" name="start[1]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'tue-start'})?>'  type="input" class="form-control" name="start[2]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'wed-start'})?>'  type="input" class="form-control" name="start[3]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'thu-start'})?>'  type="input" class="form-control" name="start[4]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'fri-start'})?>'  type="input" class="form-control" name="start[5]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'sat-start'})?>'  type="input" class="form-control" name="start[6]" placeholder="00:00">
		  </div>  
		</td>
		
	</tr>
	<tr>
		<th> <div class="form-group">End</div></th>
		<td>
		  
			<input value='<?=date('H:i',$scheduler->{'sun-end'})?>'   type="input" class="form-control" name="end[0]" placeholder="00:00"/>
		  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'mon-end'})?>'  type="input" class="form-control" name="end[1]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'tue-end'})?>'  type="input" class="form-control" name="end[2]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'wed-end'})?>'  type="input" class="form-control" name="end[3]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'thu-end'})?>'  type="input" class="form-control" name="end[4]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'fri-end'})?>'  type="input" class="form-control" name="end[5]" placeholder="00:00">
		  </div>  
		</td>
				<td>
		  <div class="form-group">
			<input value='<?=date('H:i',$scheduler->{'sat-end'})?>'  type="input" class="form-control" name="end[6]" placeholder="00:00">
		  </div>  
		</td>
		
	</tr>	
</tbody>
</table>
</div>
</div>		
</div>	
</div>
		<!--	
    <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle">My Calendar</div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
            </div>          
            
            <div id="caltoolbar" class="ctoolbar">
              <div id="faddbtn" class="fbutton">
                <div><span title='Click to Create New Event' class="addcal">

                New Event                
                </span></div>
            </div>
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Click to back to today ' class="showtoday">
                Today</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='Day' class="showdayview">Day</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='Week' class="showweekview">Week</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Month' class="showmonthview">Month</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='Refresh view' class="showdayflash">Refresh</span></div>
                </div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Prev"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Next" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">Loading</span>

                    </div>
            </div>
            
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>   
        </div>
     
  </div>
    -->

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
