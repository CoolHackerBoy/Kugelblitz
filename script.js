function makeCellTargetableIfEmpty(newTr, newTd){
	if( $('tr:nth-child('+(newTr)+') td:nth-child('+(newTd)+')').children().length == 0){
		$('tr:nth-child('+(newTr)+') td:nth-child('+(newTd)+')').addClass('moveable');
	}
}

function makeCellWithEnemyAttackableIf(newTr, newTd){
	if( $('tr:nth-child('+(newTr)+') td:nth-child('+(newTd)+')').children().length == 0){
		$('tr:nth-child('+(newTr)+') td:nth-child('+(newTd)+')').addClass('attackable');
	}
}

$(document).on('click','#current_user',function(){
	var trPosition = $(this).parent().parent().index();
	var tdPosition = $(this).parent().index()
	
	//plus
	
	makeCellTargetableIfEmpty(trPosition+0, tdPosition+1);
	makeCellTargetableIfEmpty(trPosition+1, tdPosition+2);
	makeCellTargetableIfEmpty(trPosition+2, tdPosition+1);
	makeCellTargetableIfEmpty(trPosition+1, tdPosition+0);
	
	//diangle
	makeCellTargetableIfEmpty(trPosition+0, tdPosition+0);
	makeCellTargetableIfEmpty(trPosition+0, tdPosition+2);
	makeCellTargetableIfEmpty(trPosition+2, tdPosition+0);
	makeCellTargetableIfEmpty(trPosition+2, tdPosition+2);
});

$(document).on('click','.moveable',function(){
	
	var trPosition = $(this).parent().index()+1;
	var tdPosition = $(this).index()+1;
	
	var destination_url = 'update_position.php';
	var post_object = {x_pos:tdPosition,y_pos:trPosition}
	$.post(destination_url, post_object, function( responce){
		console.log(responce)
	});
	
	$('#current_user').addClass('old_clone');
	$(this).append( $('#current_user').clone() );
	$(this).children('div').removeClass('old_clone');
	$('.old_clone').remove();
	$('.moveable').removeClass('moveable')
	
});
	
//$(document).on('click','div.player:not(#current_user)', function(){
	//alert("not allowed")
//});


