$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var first=$('#firstname'+id).text();
		var last=$('#lastname'+id).text();
		var address=$('#address'+id).text();
	
		$('#edit').modal('show');
		$('#efirstname').val(first);
		$('#elastname').val(last);
		$('#eaddress').val(address);
	});
});