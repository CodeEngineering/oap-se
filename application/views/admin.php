
      <div class="content">
        <div class="page-header">
          <h1>Sync Admin <small></small></h1>
		  <!-- <strong><?=$username?></strong> | <?php echo anchor('/auth/logout/', 'Logout'); ?> <br /> -->
		  
        </div>
        <div class="row">
          <div class="span10">

          </div>
          <div class="span2">
			<table class='table'>
				<tr>
					<th>Connection Name</th>
					<th>Source</th>
					<th>Target</th>
					<th>Next Run</th>
					<th>Run Now</th>
				</tr>
				<?php
					foreach ($jobs as $job)
					{
					?>
						<th><?=$job->connection_name?></th>
						<th><?=$job->api_source->Name?></th>
						<th><?=$job->api_target->Name?></th>
						<th><?=date('H:i:s',$job->nextrun)?></th>
						<th><a href="javascript:void(0)" onclick='runnow(<?=$job->id?>)'>Run now</a></th>
					
					<?php
					}
				?>
				
			</table>
          </div>
        </div>
      </div>
<script>
function runnow(id)
{
	$.post("<?=base_url()."Sync/runnow/"?>",{connectionid:id},function(data){
	
	alert(data.Sync+'/'+data.Total + 'sync');
	});;
	return false;
}
</script>
