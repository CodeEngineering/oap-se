
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
					<th>Log</th>
				</tr>
				<?php
					foreach ($jobs as $job)
					{
					?>
						<th><span class="state glyphicon glyphicon-time"></span><?=$job->connection_name?></th>
						<th><?=$job->api_source->Name?></th>
						<th><?=$job->api_target->Name?></th>
						<th><?=date('H:i:s',$job->nextrun)?></th>
						<th><a href="javascript:void(0)" onclick='runnow(<?=$job->id?>)'>Run now</a></th>
						<th><a href="javascript:void(0)" onclick='log()'><span class='logdate'><span class="glyphicon glyphicon-download"></span><?=date('YMd H:i:s',$job->logdate)?></span></a></th>
						<input class='logid' type='hidden' value='<?=$job->lastlog?>'>
					
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
	$('.state').removeClass('glyphicon-time');
	$('.state').addClass('glyphicon-transfer');
	$.post("<?=base_url()."sync/runnow/"?>",{connectionid:id},function(data){
	$('.logdate').text(data.date);
	$('.logid').text(data.id);
	$('.state').removeClass('glyphicon-transfer');
	$('.state').addClass('glyphicon-time');
		
	alert('Sync Completed');
	});;
	return false;
}
function log()
{
	window.location.href = './download/'+$('.logid').val();
	return false;
}
</script>
