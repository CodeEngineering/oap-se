		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>
						Sync Admin
					</div>
					<div class='col-md-2 col-md-offset-3 step_number'>&nbsp;</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						<table class='table'>
							<thead>
							<tr>
								<th>Connection Name</th>
								<th>Source</th>
								<th>Target</th>
								<th>&nbsp;&nbsp;&nbsp;</th>
								
							</tr>
							</thead>
							<tfoot>
							<tr>
								<th>Connection Name</th>
								<th>Source</th>
								<th>Target</th>
								<th>&nbsp;&nbsp;&nbsp;</th>
								
							</tr>
							</tfoot>
							<tbody>
							<?php
								foreach ($jobs as $job)
								{
								?>
									<tr id='job__<?=$job->id?>'>
									<th><span class="state glyphicon "></span><?=$job->connection_name?></th>
									<th><?=$job->api_source->Name?></th>
									<th><?=$job->api_target->Name?></th>
									<th><a href='' onclick='return delete_connection("<?=$job->connection_name?>","<?=$job->id?>")'>Delete </a>| <a href='/mapping/step01/<?=$job->id?>'>Edit</th>
									<!--
									<th><a href="javascript:void(0)" onclick='runnow(<?=$job->id?>)'>Run now</a></th>
									<th><a href="javascript:void(0)" onclick='log(<?=$job->id?>)'><span class="glyphicon glyphicon-download"></span> <span class='logdate'><?=$job->logdate?></span></a></th>
									<input class='logid' type='hidden' value='<?=$job->lastlog?>'> -->
									<tr>
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
	$('tr#job__'+id+' span.state').removeClass('glyphicon-time');
	$('tr#job__'+id+' span.state').addClass('glyphicon-transfer');
	$.post("<?=base_url()."sync/runnow/"?>",{connectionid:id},function(data){
		$('tr#job__' + id + ' span.logdate').text(data.date);
		$('tr#job__' + id +' input.logid').val(data.id);
		$('tr#job__'+id+' span.state').removeClass('glyphicon-transfer');
		$('tr#job__'+id+' span.state').addClass('glyphicon-time');
			
		alert('Sync Completed');
	});;
	return false;
}
function log(id)
{
	if ($('tr#job__' + id + ' input.logid').val()>0)
	{
	window.location.href = '../sync/download/'+$('tr#job__' + id + ' input.logid').val();
	}
	return false;
}
</script>
	