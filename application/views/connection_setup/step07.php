		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>
						Sync Admin
					</div>
					<div class='col-md-2 col-md-offset-3 step_number'>Step 7</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						<table class='table'>
							<thead>
							<tr>
								<th>Connection Name</th>
								<th>Source</th>
								<th>Target</th>
								<th>Next Run</th>
								<th>Run Now</th>
								<th>Log</th>
							</tr>
							</thead>
							<tfoot>
							<tr>
								<th>Connection Name</th>
								<th>Source</th>
								<th>Target</th>
								<th>Next Run</th>
								<th>Run Now</th>
								<th>Log</th>
							</tr>
							</tfoot>
							<tbody>
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
							</tbody>
						</table>						
			
	

					</div>
				</div>
			</div>
		</div><!-- end content -->
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
	