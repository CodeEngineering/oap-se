

		<div class="row"><!-- content -->
			<div class='col-md-10 col-md-offset-1 content'>
				<div class='row operation_step'>
					<div class='col-md-7 step_name'>API Setup</div>
					<div class='col-md-2 col-md-offset-3 step_number'>&nbsp;</div>
				</div>
				<div class='row content_data'>
					<div class='col-md-12'>
						<ul class="nav nav-tabs" id="myTab">
						  <li class="active"><a href="#oap" data-toggle="tab">OAP</a></li>
						  <li><a href="#se" data-toggle="tab">Social Engine</a></li>
						  
						  
						</ul>

						<div class="tab-content">
						  <div class="tab-pane active" id="oap">
						  OAP Credentials
							<form role="form">
							  <div class="form-group">
								<label for="Appid">App ID</label>
								<input type="text" class="form-control" id="Appid" placeholder="OAP App ID">
							  </div>
							  <div class="form-group">
								<label for="key">Key</label>
								<input type="text" class="form-control" id="key" placeholder="OAP App key">
							  </div>
							 
							 
							  <button type="submit" class="btn btn-default">Submit</button>
							</form>						  
						  </div>
						  <div class="tab-pane" id="se">SE Credentials
						  
						  	<form role="form">
							  <div class="form-group">
								<label for="Appid">SE API Location</label>
								<input name='SE_target' type="text" class="form-control" id="Appid" placeholder="http://clickinback.com">
							  </div>

							 
							 
							  <button type="submit" class="btn btn-default">Submit</button>
							</form>	
						  </div>
						  
						  
						  
						</div>
					</div>
				  
				</div>
			</div>
		</div><!-- end content -->
		
		
					<script>
					  $(function () {
						$('#myTab a:last').tab('show')
					  })	

</script>	