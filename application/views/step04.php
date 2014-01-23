
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step 4</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Define filters for  <strong><?=$connectors_list[$connection->api_source]?></strong></h3>
          </div>
          <div class="span2">
			
			<?php echo form_open('mapping/step04',array('name'=>'step04','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
			<?= form_hidden('form', 'step03');?>
			<?= form_hidden('id', $connection->id);?>
			
		<?php
		
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		
		
		 ?>  
		 <div class='filter_'>
		  <div class="form-group">
			<label for="api_source" class="col-sm-2 control-label">Filter Field</label>
			<div class="col-sm-3">
			<?=form_dropdown('api_source_filter_field[]',$api_source_fields,'',"id='api_source_fields' class='form-control'") ?> 
			</div>
		  </div>   
		  <div class="form-group">
			<label for="api_source" class="col-sm-2 control-label">Operation</label>
			<div class="col-sm-3">
			<?=form_dropdown('api_source_filter_operation[]',$api_source_filter,'',"id='api_source_filter_operation' class='form-control'") ?> 
			</div>
		  </div>   		  
		  <div class="form-group">
			<label for="api_source" class="col-sm-2 control-label">Value</label>
			<div class="col-sm-3">
				<input name='filter-value[]' type="text" class="form-control" id="filter-value" placeholder="Filter value" value=''>
			</div>
		  </div> 
		  <div class="form-group">
		  <label for="api_source" class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-5" style='text-align:left'>
						<button id='create-filter' type="button" class="btn btn-primary">
						<span class="glyphicon glyphicon-filter"></span> Add filter
						</button>   
			</div>
		  </div>  
		</div>
		<table class='table' id='filter_list'>
			<tr>
				<th>Field name</th>
				<th>Operation</th>
				<th>Value</th>
				<th>Edit/Delete</th>
			</tr>
		</table>
  
  <div class="form-group">
    <div class="col-sm-5" style='text-align:right'>
  				<button type="submit" class="btn btn-primary">
				<span class="glyphicon glyphicon-arrow-right"></span> Next
				</button>   
    </div>
  </div>  

			<?php
			echo form_close();
			?>

			
          </div>
        </div>
      </div>

<script>
var filter_types=<?=json_encode($api_source_filter)?>;
var field_types=<?=json_encode($api_source_type)?>;


$('#create-filter').click(function(){
tr="<tr><td>"+$('#api_source_fields option:selected').text()+"</td><td>"+$('#api_source_filter_operation option:selected').text()+"</td><td>"+$('#filter-value').val()+"</td><td><span class=' edit_filter glyphicon glyphicon-edit'></span>&nbsp;&nbsp;<span class='delete_filter glyphicon glyphicon-remove'></span></td></tr>";
$('#filter_list > tbody:last').append(tr);

	$('<input type="hidden" value="'+hide+'">')
	
	$('.delete_filter').click(function(){
	$(this).parents('tr').remove();

	});
	$('.edit_filter').click(function(){
		tr=$(this).parents('tr');
		//$('tr').find('td:eq(0)')
		$("#api_source_fields option:contains("+$(tr).find('td:eq(0)').text()+")").attr('selected', true);
		$("#api_source_filter_operation option:contains("+$(tr).find('td:eq(1)').text()+")").attr('selected', true);
		$("#filter-value").val($(tr).find('td:eq(2)').text());
		$(this).parents('tr').remove();
		
		
	});



});



</script>