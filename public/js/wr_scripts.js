$(document).ready(function(){
	//for skills progree-bar
	$('.progress-bar-success').map(function(){
		var skill_value = $(this).attr('skill-val');
		if( skill_value == 0 || skill_value < 35 ) {
			$(this).filter(function(skill_value) {
				var x = $(this).attr("skill-val");
	        	return skill_value == 0 || skill_value < 35;
			}).css('background-color','red');
		} else if( skill_value == 35 || skill_value < 75 ) {
			$(this).filter(function(skill_value) {
				var y = $(this).attr("skill-val");
	        	return skill_value == 35 || skill_value < 75;
			}).css('background-color','yellow');
		} else if( skill_value == 75 || skill_value <= 100 ) {
			$(this).filter(function(skill_value) {
				var z = $(this).attr("skill-val");
	        	return skill_value == 75 || skill_value <= 100;
			}).css('background-color','green');
		}
	});
});