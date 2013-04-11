//search popover
(function(){
	$('#search').popover({
		content: "<form class='form-search' id='search-form'><div class='input-append'><input type='text' class='input-medium search-query'><button type='submit' class='btn'><i class='icon-search'></i></button></div></form>",
		html: true
	});
})();

//change breadcrumb
$('a').click(function(){	
	var href = $(this).attr('href');
	if(href.substr(1,8) === 'project_'){
		$('li').remove('#added-bc');
		$('.breadcrumb').append('<li id="added-bc"><a href="#project-management">项目管理</a> <span class="divider">></span></li>');
		$('.breadcrumb').append("<li class='active' id='added-bc'>" + $(this).text() + "</li>");
	}else if(href === '#home'){
		$('li').remove('#added-bc');
	}else{
		$('li').remove('#added-bc');
		$('.breadcrumb').append("<li class='active' id='added-bc'>" + $(this).text() + "</li>");
	}
});

//progress bar
(function(){
	var p = 0;
	var int;
	int = setInterval(function(){
		$('.bar').css('width', (p+=1)+'%');
		if(p === 100){
			clearInterval(int);
		}
	}, 1000);
})();

//collapse
$('#proj-m').collapse('show');