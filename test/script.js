// JavaScript Document
$(document).ready(
	function() {
    	$('#registerbtn').click( function()
		{
			$.post("register.php", 
				{
					newuser : $( '#newuser' ).val(),
					newpass : $( '#newpass' ).val()
				}, 
				function(data){$('#regstatus').val(data)});
		});
	}
);
