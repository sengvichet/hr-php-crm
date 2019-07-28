// event page
$( document ).ready(function() {
	if(document.getElementById('eventPage'))
	{
		if(document.getElementById('eventSelect').value != "")
		{
		  document.getElementById('eventSelected').value = $('#eventSelect option:selected').text();
		}
		
		$( "#eventSelect" ).change(function() {
			$("#eventSelectSubmit").click();
		});
	}
});