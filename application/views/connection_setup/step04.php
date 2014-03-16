		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>
Define filters for  <strong><?=$connectors_list[$connection->api_source]?></strong>
					</div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 4</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step05',array('name'=>'step04','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step04');?>
			<?= form_hidden('id', $connection->id);?>
			
		<?php
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		
		
		 ?> 	
		 <div class='filter_'>
		  <div class="form-group has-feedback">
			<label for="api_source" class="col-sm-3 control-label">Filter Field</label>
			<div class="col-sm-8">
			<?=form_dropdown('api_source_filter_field[]',$api_source_fields,'',"id='api_source_fields' class='form-control'") ?> 
			<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
			</div>
		  </div>   
		  <div class="form-group has-feedback">
			<label for="api_source" class="col-sm-3 control-label">Operation</label>
			<div class="col-sm-8">
			<?=form_dropdown('api_source_filter_operation[]',$api_source_filter,'',"id='api_source_filter_operation' class='form-control'") ?> 
			<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
			</div>
		  </div>   		  
		  <div class="form-group has-feedback">
			<label for="api_source" class="col-sm-3 control-label">Value</label>
			<div class="col-sm-8">
				<input name='filter-value[]' type="text" class="form-control" id="filter-value" placeholder="Filter value" value=''>
				<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
			</div>
		  </div> 
		  <div class="form-group">
		  <label for="api_source" class="col-sm-3 control-label">&nbsp;</label>
			<div class="col-sm-8" style='text-align:left'>
						<button id='create-filter' type="button" class="btn btn-primary">
						<span class="glyphicon glyphicon-filter"></span> Add filter
						</button>   
			</div>
		  </div>  
		</div>
				
		<table class='table' id='filter_list'>
			<thead>
				<tr>
					<th>Field name</th>
					<th>Operation</th>
					<th>Value</th>
					<th>Edit/Delete</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Field name</th>
					<th>Operation</th>
					<th>Value</th>
					<th>Edit/Delete</th>
				</tr>
			</tfoot>
			<tbody>
			<?php
				$filters=json_decode($connection->source_filter,true);
				$filters=is_array($filters)?$filters:array('field'=>array(),'operation'=>array(),'value'=>array());
				//print_r($api_source_fields);
				foreach ($filters['field'] as $key=>$filter)
				{
					//echo $filters['field'][$key];
					$fields=explode('__',$filters['field'][$key]);
					//print_r($fields);
					?>
					<tr>
						<td><?=$api_source_fields["{$fields[0]}"][$filters['field'][$key]]?></td>
						<td><?=$api_source_filter[$filters['operation'][$key]]?></td>
						<td><?=$filters['value'][$key]?></td>
						<td>
							<span class=' edit_filter glyphicon glyphicon-edit'>
							</span>&nbsp;&nbsp;<span class='delete_filter glyphicon glyphicon-remove'></span>
						</td>
						<input class="filter_field" name="source_filter_field[]" type="hidden" value="<?=$filters['field'][$key]?>"/>
						<input class="filter_operation" name="source_filter_operation[]" type="hidden" value="<?=$filters['operation'][$key]?>"/>
						<input class="filter_value" name="source_filter_value[]" type="hidden" value="<?=$filters['value'][$key]?>"/>
					</tr>
					
					<?php
				}
			?>
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
var filter_types=<?=json_encode($api_source_filter)?>;
var field_types=<?=json_encode($api_source_type)?>;

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