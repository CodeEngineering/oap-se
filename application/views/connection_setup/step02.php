		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>Select Target fields for <strong><?=$connectors_list[$connection->api_target]?></strong></div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 2</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step03',array('name'=>'step02','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step02');?>
			<?= form_hidden('id', $connection->id);?>
		<?php
		$include=json_decode($connection->target_fields);
		$include=is_array($include)?$include:array();
		
		foreach ($api_target_fields as $key=>$val)
		{
		?>
						
				<div class="checkbox">
				  <label>
					<input id='targetapi<?=$key?>' type="checkbox" name='api_targets[]' value="<?=$key?>" <?=in_array($key,$include)?'checked':''?>>
					
					<label for="targetapi<?=$key?>"><span></span><?=$val?></label>
				  </label>
				</div>
			
		 <?php } ?>  		

							
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10 navigation">
							  <button type="submit" class=" btn btn-primary blue" ><span class=' glyphicon glyphicon-arrow-left'></span>&nbsp;&nbsp;Back</button>
							  <button type="submit" class="btn btn-primary blue">Next &nbsp;&nbsp;<span class='glyphicon glyphicon-arrow-right'></span> </button>
							</div>
						  </div>
						</form>

					</div>
				</div>
			</div>
		</div><!-- end content -->