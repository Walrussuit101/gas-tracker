function notifyTripSaved(startmileage){ 
	
	$('#startMileageNotification').text("at " + startmileage + " mi.");
	
	$('.tripSaved').fadeIn("slow", function() {
		$('.tripSaved').delay(3000).fadeOut("slow");
	});
}

function notifyTripEnded(totalDistance){ 
	
	$('#totalDistanceNotification').text("total dis. " + totalDistance + " mi.");
	
	$('.tripEnded').fadeIn("slow", function() {
		$('.tripEnded').delay(3000).fadeOut("slow");
	});
}

