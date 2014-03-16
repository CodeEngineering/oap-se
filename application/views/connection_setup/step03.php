		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>Map Source fields  <strong><?=$connectors_list[$connection->api_source]?> </strong> to target fields  <strong><?=$connectors_list[$connection->api_target]?> </div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 3</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step04',array('name'=>'step04','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step03');?>
			<?= form_hidden('id', $connection->id);?>
			
	
					<?php
		
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		$counter=0;
		$source_fields=json_decode($connection->source_fields);
		//print_r($source_fields);
		//print_r($api_source_fields);
		foreach ($api_target_fields as $key=>$val)
		{
		?>
			 <div class="checkbox">
			  <label>
					<div class="form-group has-feedback">
					<label for="api_source_<?=$key?>" class="col-sm-3 control-label"><?=$val?></label>
					<div class="col-sm-8">
					<?php
					//$api_source_fields[$connection->source_fields[$counter]]
					
					$selection=isset($source_fields[$counter])?$source_fields[$counter]:'';
					?>
					<?=form_dropdown('api_source_fields[]',$api_source_fields,$selection,"id='api_source_$key' class='form-control  DataTarget'") ?>
					<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
					</div>
					</div>
			  </label>
			</div>
	
		 <?php 
		 $counter++;
		 } 
		 ?> 

				

						  
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