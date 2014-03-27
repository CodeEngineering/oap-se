		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>Create Connection</div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 1</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						
			
			<?php echo form_open('mapping/step02',array('name'=>'step01','method'=>'post','class'=>"form-horizontal form_label", "role"=>"form"));?>
			<?= form_hidden('form', 'step01');?>
			<?= form_hidden('id', $connection->id);?>
			
						  <div class="form-group  has-feedback">
							<label for="Connection_name" class="col-sm-3 control-label">Connection Name</label>
							<div class="col-sm-8">
							  <input name='connection_name' type="text" class="form-control" id="Connection_name" placeholder="Connection Name" value='<?=$connection->connection_name?>'><span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
							</div>
						  </div>
						  <div class="form-group  has-feedback">
							<label for="Description" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
							 
							  <textarea name='description' id="Description" placeholder="Description" class="form-control" rows="5"><?=$connection->description?></textarea>
							  <span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
							</div>
						  </div>
						  <div class="form-group  has-feedback">
							<label for="DataSource" class="col-sm-3 control-label">Data Source</label>
							<div class="col-sm-8">
							  <?=form_dropdown('api_source',$connectors_list,"$connection->api_source","id='api_source' class='form-control datasource'") ?>
							  

								<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
							</div>
						  </div>	
						  <div class="form-group  has-feedback">
							<label for="DataTarget" class="col-sm-3 control-label">Data Target</label>
							<div class="col-sm-8">
								<?=form_dropdown('api_target',$connectors_list,"$connection->api_target","id='api_source' class='form-control DataTarget'") ?>
							
								<span class='hint form-control-feedback link'  data-original-title="this is the description of the api connection"></span>
							</div>
						  </div>		
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10 navigation">
							  <button onclick ="step('step00')" type="submit" class="disabled btn btn-primary blue back" ><span class=' glyphicon glyphicon-arrow-left'></span>&nbsp;&nbsp;Back</button>
							  <button  type="submit" class="btn btn-primary blue next">Next &nbsp;&nbsp;<span class='glyphicon glyphicon-arrow-right'></span> </button>
							</div>
						  </div>
						</form>

					</div>
				</div>
			</div>
		</div><!-- end content -->