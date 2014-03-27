<div class='row'><!-- footer-->
		<div class='col-md-12 footer'>Copyright <span class='glyphicon glyphicon-copyright-mark'></span>2014 Cubatica.com</div>
	</div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	
	<script>
	$('.link').tooltip({placement:'right'});
	function step(step0)
	{
		console.log(step0);
		$('input[name="form"]').val(step0);
		
		$("form").attr("action", "/mapping/" + step0);
		
		window.location = "/mapping/" + step0+"/"+$('input[name=id]').val();
		return false;
	}
	function delete_connection(connectionname,connectionid)
	{
		if (confirm("You are about to Delete connection :" + connectionname)) {
        window.location="/mapping/delete/"+connectionid;
    }
    return false;
	}
	</script>
	</body>
</html>