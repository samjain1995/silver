$(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');
 })



 $('#setC input').click(function() {
	$('#setC input').not(this).prop('checked', false);
});


$('#setD input').click(function() {
	if (this.attr('checked', true)) {
		this.removeAttr("checked");
}
});


