
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step1</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Create connection</h3>
          </div>
          <div class="span2">
			
			<?php echo form_open('mapping/step02',array('name'=>'step01','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
			<?= form_hidden('form', 'step01');?>
			<?= form_hidden('id', $connection->id);?>
			
  <div class="form-group">
    <label for="connection_name" class="col-sm-2 control-label">Connection name</label>
    <div class="col-sm-3">
      <input name='connection_name' type="text" class="form-control" id="connection_name" placeholder="Connection name" value='<?=$connection->connection_name?>'>
    </div>
  </div>
  
    <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-3">
      
	  <textarea  name='description' id='description' class="form-control" rows="3" placeholder="Description"><?=$connection->description?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="api_source" class="col-sm-2 control-label">Data Source</label>
    <div class="col-sm-3">
      
	  <?=form_dropdown('api_source',$connectors_list,"$connection->api_source","id='api_source' class='form-control'") ?>
    </div>
  </div>
  <div class="form-group">
    <label for="api_source" class="col-sm-2 control-label">Data target</label>
    <div class="col-sm-3">
		<?=form_dropdown('api_target',$connectors_list,"$connection->api_target","id='api_source' class='form-control'") ?>
     
    </div>
  </div>
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

