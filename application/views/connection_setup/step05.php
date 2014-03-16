		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>
Schedule to excute <strong><?=$connection->connection_name?></strong>
					</div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 5</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step06',array('name'=>'step05','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step05');?>
			<?= form_hidden('id', $connection->id);?>
			<?=form_input(array('name' => 'connectionid', 'type'=>'hidden', 'id' =>'connectionid','value'=>$connection->id));?>
			<?=form_input(array('name' => 'connection_name', 'type'=>'hidden', 'id' =>'connection_name','value'=>$connection->connection_name));?>
			<?=form_input(array('name' => 'schedule', 'type'=>'hidden', 'id' =>'schedule','value'=>$connection->schedule));?>			
		<?php
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		
		
		 ?> 	

<div class='row'>

<div class="panel panel-primary">
<div class="panel-heading">Daily Schedule</div>
 <div class="panel-body">		  
<div class="col-md-6">
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


<div class="col-md-6">
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
	<div class="col-md-12">
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
<div class="col-md-12 col-md-offset-0">		  
<table class='table '>
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
<tfoot>
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
</tfoot>
<tbody>
	<tr>
		<th>Enabled</th>
		<td>  
			<div class="checkbox">
				
				  <input id='d0' <?=$scheduler->{'sun-enabled'}==1?'checked':'' ?> name='enabled[0]' type="checkbox"> <label for='d0'><span>&nbsp;</span></label>
				
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  id='d1' <?=$scheduler->{'mon-enabled'}==1?'checked':'' ?>  name='enabled[1]' type="checkbox"> <label  for='d1'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  id='d2' <?=$scheduler->{'tue-enabled'}==1?'checked':'' ?>  name='enabled[2]' type="checkbox"> <label  for='d2'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input   id='d3' <?=$scheduler->{'wed-enabled'}==1?'checked':'' ?> name='enabled[3]' type="checkbox"> <label  for='d3'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input  id='d4'  <?=$scheduler->{'thu-enabled'}==1?'checked':'' ?>  name='enabled[4]' type="checkbox"> <label  for='d4'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input   id='d5' <?=$scheduler->{'fri-enabled'}==1?'checked':'' ?>  name='enabled[5]' type="checkbox"> <label  for='d5'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>
		<td>  
			<div class="checkbox">
				<label>
				  <input   id='d6' <?=$scheduler->{'sat-enabled'}==1?'checked':'' ?> name='enabled[6]' type="checkbox"> <label  for='d6'><span>&nbsp;</span></label>
				</label>
			</div>
		</td>

		
	</tr>
	<tr>
		<th> Start</th>
		<td>
		  
			<input value='<?=date('H:i',$scheduler->{'sun-start'})?>' type="time" class="form-control time" name="start[0]" placeholder="00:00">
		  
		</td>
				<td>
		  
			<input value='<?=date('H:i',$scheduler->{'mon-start'})?>'  type="time" class="form-control time" name="start[1]" placeholder="00:00">
		  
		</td>
				<td>

			<input value='<?=date('H:i',$scheduler->{'tue-start'})?>'  type="time" class="form-control time" name="start[2]" placeholder="00:00">
		  
		</td>
				<td>

			<input value='<?=date('H:i',$scheduler->{'wed-start'})?>'  type="time" class="form-control time" name="start[3]" placeholder="00:00">
		
		</td>
				<td>
		  
			<input value='<?=date('H:i',$scheduler->{'thu-start'})?>'  type="time" class="form-control time" name="start[4]" placeholder="00:00">
		  
		</td>
				<td>

			<input value='<?=date('H:i',$scheduler->{'fri-start'})?>'  type="time" class="form-control time" name="start[5]" placeholder="00:00">
		 
		</td>
				<td>
		 
			<input value='<?=date('H:i',$scheduler->{'sat-start'})?>'  type="time" class="form-control time" name="start[6]" placeholder="00:00">

		</td>
		
	</tr>
	<tr>
		<th>End</th>
		<td>
		  
			<input value='<?=date('H:i',$scheduler->{'sun-end'})?>'   type="time" class="form-control time" name="end[0]" placeholder="00:00"/>
		  
		</td>
				<td>
		  
			<input value='<?=date('H:i',$scheduler->{'mon-end'})?>'  type="time" class="form-control time" name="end[1]" placeholder="00:00">

		</td>
				<td>
			<input value='<?=date('H:i',$scheduler->{'tue-end'})?>'  type="time" class="form-control time" name="end[2]" placeholder="00:00">
		
		</td>
				<td>
		 
			<input value='<?=date('H:i',$scheduler->{'wed-end'})?>'  type="time" class="form-control time" name="end[3]" placeholder="00:00">
		 
		</td>
				<td>

			<input value='<?=date('H:i',$scheduler->{'thu-end'})?>'  type="time" class="form-control time" name="end[4]" placeholder="00:00">
		 
		</td>
				<td>
			<input value='<?=date('H:i',$scheduler->{'fri-end'})?>'  type="time" class="form-control time" name="end[5]" placeholder="00:00">
		
		</td>
				<td>
		  
			<input value='<?=date('H:i',$scheduler->{'sat-end'})?>'  type="time" class="form-control time" name="end[6]" placeholder="00:00">
		 
		</td>
		
	</tr>	
</tbody>
</table>
</div>
</div>		
</div>	
</div>

		 
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10 navigation">
							  <button type="submit" class="disabled btn btn-primary blue" ><span class=' glyphicon glyphicon-arrow-left'></span>&nbsp;&nbsp;Back</button>
							  <button type="submit" class="btn btn-primary blue">Next &nbsp;&nbsp;<span class='glyphicon glyphicon-arrow-right'></span> </button>
							</div>
						  </div>
						</form>

					</div>
				</div>
			</div>
		</div><!-- end content -->

<script>
/* var filter_types=<?=json_encode($api_source_filter)?>;
var field_types=<?=json_encode($api_source_type)?>; */

	$('.delete_filter').click(function(){
		$(this).parents('tr').remove();
	});
	$('.edit_filter').click(function(){
		tr=$(this).parents('tr');
		//$('tr').find('td:eq(0)')
		$("#api_source_fields").val($(tr).find('input.filter_field').val());//.attr('selected', true);
		$("#api_source_filter_operation").val($(tr).find('input.filter_operation').val());
		$("#filter-value").val($(tr).find('input.filter_value').val());
		$(this).parents('tr').remove();
		
		
	});
$('#create-filter').click(function(){
tr="<tr><td>"+$('#api_source_fields option:selected').text()+"</td><td>"+$('#api_source_filter_operation option:selected').text()+"</td><td>"+$('#filter-value').val()+"</td><td><span class=' edit_filter glyphicon glyphicon-edit'></span>&nbsp;&nbsp;<span class='delete_filter glyphicon glyphicon-remove'></span></td></tr>";
$('#filter_list > tbody:last').append(tr);

	$('<input class="filter_field" name=\'source_filter_field[]\' type="hidden" value="'+$('#api_source_fields option:selected').val()+'">').appendTo($("#filter_list >tbody>tr:last"));;
	$('<input class="filter_operation"  name=\'source_filter_operation[]\' type="hidden" value="'+$('#api_source_filter_operation option:selected').val()+'">').appendTo($("#filter_list >tbody>tr:last"));;
	$('<input  class="filter_value"  name=\'source_filter_value[]\' type="hidden" value="'+$('#filter-value').val()+'">').appendTo($("#filter_list >tbody>tr:last"));;
	//x.appendTo($("#filter_list >tbody>tr:last"));
	
	$('.delete_filter').click(function(){
		$(this).parents('tr').remove();
	});
	$('.edit_filter').click(function(){
		tr=$(this).parents('tr');
		//$('tr').find('td:eq(0)')
		$("#api_source_fields").val($(tr).find('input.filter_field').val());//.attr('selected', true);
		$("#api_source_filter_operation").val($(tr).find('input.filter_operation').val());
		$("#filter-value").val($(tr).find('input.filter_value').val());
		$(this).parents('tr').remove();
		
		
	});



});



</script>		