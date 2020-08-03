$(document).ready(function(){
	var numentries = $('.grid-tile').length - 1;
	//alert(numentries);
	var count = 0;
	$('#search').click(function(){
		$(".grid-tile .item-pnl .pnl-wrapper .pnl-description").find(".pnl-label").each(function(index){
			$(this).parent().parent().parent().parent().show();
		});
		//var fieldvalue = $('#field').val();
		var keyword = $('#keyword').val();
		//alert(fieldvalue);
		//var td_index = tdIndex(fieldvalue);
		//alert(td_index);
		count = 0;
		$(".grid-tile .item-pnl .pnl-wrapper .pnl-description").find(".pnl-label").each(function(index){
			var mydata= $(this).text();
			//var test = $("td").eq(td_index).text();
			//alert(mydata);
			if(mydata.toLowerCase().search(keyword.toLowerCase())==-1){
				$(this).parent().parent().parent().parent().hide();
				count++;
			}
		});
	
	});
});