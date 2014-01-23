
      <div class="content">
        <div class="page-header">
          <h1>API connector <small>Step2</small></h1>
		  <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br />
		  
        </div>
        <div class="row">
          <div class="span10">
				<h3>Select Target fields for <strong><?=$connectors_list[$connection->api_target]?></strong></h3>
          </div>
          <div class="span2">
			
			<?php echo form_open('mapping/step03',array('name'=>'step01','method'=>'post','class'=>"form-horizontal", "role"=>"form"));?>
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
				<input type="checkbox" name='api_targets[]' value="<?=$key?>" <?=in_array($key,$include)?'checked':''?>>
				<?=$val?>
			  </label>
			</div>

		 <?php } ?>  
   
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

