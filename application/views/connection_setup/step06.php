		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>
						Summary <strong><?=$connection->connection_name?></strong>
					</div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 5</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step07',array('name'=>'step06','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step06');?>
			<?= form_hidden('id', $connection->id);?>
			<?=form_input(array('name' => 'connectionid', 'type'=>'hidden', 'id' =>'connectionid','value'=>$connection->id));?>
			<?=form_input(array('name' => 'connection_name', 'type'=>'hidden', 'id' =>'connection_name','value'=>$connection->connection_name));?>
			<?=form_input(array('name' => 'schedule', 'type'=>'hidden', 'id' =>'schedule','value'=>$connection->schedule));?>	

				
		<?php
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		
		
		 ?> 	
 <table class='table'>
 <thead>
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
 </thead> 
 <tfoot>
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
 </tfoot>
 <tbody>
		  <tr>
			<th>Connection Name</th>
			<td><?=$connection->connection_name;?></td>
		  </tr>
		  <tr>
			<th>Description</th>
			<td><?=$connection->description;?></td>
		  </tr>
		  
		  <tr>
			<th>Data Source</th>
			<td><?=$connection->api_source;?></td>
		  </tr>
		  <tr>
			<th>Target API</th>
			<td><?=$connection->api_target;?></td>
		  </tr>
		  <tr>
			<th>Schedule</th>
			<td>
				<table class='table'>
				<thead>
					<tr>
						
						<th>Day</th>
						<th>From</th>
						<th>To</th>
						<th>Interval(hrs)</th>
						
					</tr>
				</thead>
				<tfoot>
					<tr>
						
						<th>Day</th>
						<th>From</th>
						<th>To</th>
						<th>Interval(hrs)</th>
						
					</tr>
				</tfoot>
				<tbody>
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
				</tbody>
				</table>
			</td>
		  </tr>
</tbody>
		  </table>

		 
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