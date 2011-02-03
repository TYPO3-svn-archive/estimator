
function calculteTaskHours(clickedObj){
	
	clickedObj = $(clickedObj);
	var totalHours = 0;
	var totalChargedHours = 0;	
	
	$(clickedObj).parents('.tx_estimator_pi1').find('.task-item-selected').each(function(){
		totalHours += parseInt($(this).find('.duration').attr('value'));		
	});
	
	var totalhoursElm = $(clickedObj).parents('.tx_estimator_pi1').find('.estimator-totalhours');
	var totalChargedHoursElm = $(clickedObj).parents('.tx_estimator_pi1').find('.estimator-totalchargedhours');
	var totalDaysElm = $(clickedObj).parents('.tx_estimator_pi1').find('.estimator-totaldays');
	var hoursPerDay = $(clickedObj).parents('.tx_estimator_pi1').find('.hoursPerDay').attr('value');
	var nonChargedHours = $(clickedObj).parents('.tx_estimator_pi1').find('.estimator-nonchargedhours').attr('value');
	if(nonChargedHours == '')
		nonChargedHours = 0;
	else
		nonChargedHours = parseInt(nonChargedHours);
	if(totalHours !=0 )
		totalChargedHours = totalHours - nonChargedHours;
	totalhoursElm.attr('value',totalHours);
	totalChargedHoursElm.attr('value',totalChargedHours);
	totalDaysElm.attr('value', roundToHalfDays( totalChargedHours , hoursPerDay )  );
	
}

function roundToHalfDays(totalHours,hoursPerDay){
	
	if(totalHours == 0) return totalHours;
	
	originalVal = totalHours / hoursPerDay;
	
	var roundedToFull = parseInt(originalVal);
	var digitsToAdd = (Math.round(originalVal*10)/10) - roundedToFull;	
	
	if( digitsToAdd > 0 && digitsToAdd <= 0.5 ){
		digitsToAdd = .5;
	}else if(digitsToAdd > 0.5){
		digitsToAdd = 1
	}
	
	return roundedToFull + digitsToAdd;
}

function cleanUpTasks() {
	$('.task-item').removeClass('task-item-selected');
	calculteTaskHours('.tx_estimator_pi1 span.additem');
}
function applyTasksFromTemplate(clickedObj){
	
	var selectorObj  = $(clickedObj).parents('.tx_estimator_pi1').find('.task-template-selector');
	var taskIds = selectorObj.val().split(',');

	cleanUpTasks();
	
	$.each(taskIds, function(key, value) { 
		$('#estimator-task-item-'+value).addClass('task-item-selected');	
	});
	calculteTaskHours(clickedObj);
	$(clickedObj).parents('.tx_estimator_pi1').find(".estimator_tabs" ).tabs( "select" , 0 );
	$(clickedObj).parents('.tx_estimator_pi1').find(".estimator-accordion" ).accordion( "activate" , 1 );
}


/* Invoke various functions / UI */
jQuery(document).ready(function() {
		$('.estimator-accordion').accordion({icons:{header: "ui-icon-circle-arrow-e",headerSelected: "ui-icon-circle-arrow-s"},collapsible:true,autoHeight: false});
		$('.estimator-accordion-summary').accordion({icons:{header: "ui-icon-circle-arrow-e",headerSelected: "ui-icon-circle-arrow-s"},collapsible:false,autoHeight: false});
		$( ".estimator_tabs" ).tabs();
		$( "input:submit, .estimator-prepare-mail").button();
		
		cleanUpTasks();
		
		$('.addtemplateitems').bind('click', function(){applyTasksFromTemplate(this)} );
		$(".additem").bind('click',function(){
		
			var parentElement = $(this).parents('.task-item');
			if( parentElement.hasClass('task-item-selected') ){
				parentElement.removeClass('task-item-selected');
				parentElement.find('.additem').addClass('ui-icon-plusthick');
				parentElement.find('.additem').removeClass('ui-icon-minus');				
			}
			else{
				parentElement.addClass('task-item-selected');
				parentElement.find('.additem').removeClass('ui-icon-plusthick');
				parentElement.find('.additem').addClass('ui-icon-minus');				
			}
			calculteTaskHours(this);
			
		});
});