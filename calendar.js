<!DOCTYPE html>
<html>
<head><title>My Calendar</title></head>
<body>
<script type="text/javascript">
// For our purposes, we can keep the current month in a variable in the global scope
var currentMonth = new Month(2012, 9); // October 2012
 
// Change the month when the "next" button is pressed
document.getElementById("next_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);
 
 
// This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
// it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
function updateCalendar(){
	var weeks = currentMonth.getWeeks();
 
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects.
 
		alert("Week starting on "+days[0]);
 
		for(var d in days){
			// You can see console.log() output in your JavaScript debugging tool, like Firebug,
			// WebWit Inspector, or Dragonfly.
			console.log(days[d].toISOString());
		}
	}
}
</script>
</body>
</html>
