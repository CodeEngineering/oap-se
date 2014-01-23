
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step 3</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Map Source fields  <strong><?=$connectors_list[$connection->api_source]?> </strong> to target fields  <strong><?=$connectors_list[$connection->api_target]?> </strong></h3>
          </div>
          <div class="span2">
			
			<?php echo form_open('mapping/step04',array('name'=>'step04','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
			<?= form_hidden('form', 'step03');?>
			<?= form_hidden('id', $connection->id);?>
			
		<?php
		
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		$counter=0;
		$source_fields=json_decode($connection->source_fields);
		foreach ($api_target_fields as $key=>$val)
		{
		?>
			 <div class="checkbox">
			  <label>
					<div class="form-group">
					<label for="api_source_<?=$key?>" class="col-sm-2 control-label"><?=$val?></label>
					<div class="col-sm-3">
					<?php
					//$api_source_fields[$connection->source_fields[$counter]]
					
					$selection=array_key_exists($source_fields[$counter],$api_source_fields)?$source_fields[$counter]:'';
					?>
					<?=form_dropdown('api_source_fields[]',$api_source_fields,$selection,"id='api_source_$key' class='form-control'") ?>
					
					</div>
					</div>
			  </label>
			</div>
	
		 <?php 
		 $counter++;
		 } 
		 ?>  
   
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

