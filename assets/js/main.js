

jQuery(document).ready(function($) {
	window.onbeforeunload = function(){
		$('select option').css('visibility','hidden')
						  .prop('selected', function() {
		        return this.defaultSelected;
		    });
    	
	}
	$('.seletor-categoria').change(function(e){
		if ($(this).children('option:selected').attr('value') == -1){
				id=$(this).attr('id');
			window.location.replace('/'+id);
			
		}
	   	var meta = {};
	   	var data = {'action': 'filtra_cat'};
       	meta['post_type'] = $(this).attr('id');
		meta['term']=$( "select option:selected" ).attr('value');
		meta['taxonomy']=$(this ).attr('data-taxonomy');
		data.meta = meta;
		console.log(data);
	   	$.ajax({
			type: 'POST',
	  	 	url: odin_main.ajaxurl,
		   	data: data,
		   	dataType: 'json',
		   	complete: function(response){
				var obj = $.parseJSON(response.responseText);
				console.log(obj.html)
				
					$('#conteudo-filtro').html(obj.html);
				
	   		},
	   	});
	});
	
	$( "#busca-form" ).submit(function( event ) {
		if ($('#inputbusca').val().length < 3){
			alert( "Você precisa digitar pelo menos 3 caracteres para buscar" );
		  	event.preventDefault();
		}
	});	
	var altura_primary = function() {
		imagem_h = $('#faixa img').css('height' );
		imagem_h = parseInt(imagem_h);
		$('#content').css('margin-top', imagem_h+20+'px');	
		$('#faixa').css('height', imagem_h);
	
		
	
		// 
		// article_h = $( '#primary article' ).css('height');
		// content_h = $( '#content' ).innerHeight();
		// console.log('article: '+article_h+' content: '+ content_h)
		// 
		// article_h_num = parseInt(article_h);
		// content_h_num = parseInt(content_h);
		// 
		// if (content_h_num < article_h_num) {
		// 	console.log('trocando '+content_h+' por '+ article_h)
		// 	$( '#content' ).css('height' , article_h);
		// 	pri_h = $( '#content' ).outerHeight(true);
		// 	console.log('pri_h'+pri_h);
		// 	$('#primary').css('height',pri_h);
		// 	
		// 	
		// 
		// } else {
		// 	}

	};

	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();
	// altura_primary();
	$( window ).resize(function(){
		// altura_primary()
	});
	
	$(document).on(
	{
	    mouseenter: function() 
	    {
			classe = $( this ).attr('class')
		    $( '#'+classe).addClass( 'borda' );
	    },
	    mouseleave: function()
	    {
		    $( '#'+classe).removeClass( 'borda' );
	    }
	}
	, '#lista_titulos li h4');
	$(document).on(
	{
	    mouseenter: function() 
	    {
			id = $( this ).attr('id');
			console.log($( '.'+id));
			
		    $( '.'+id).addClass( 'borda' );
	    },
	    mouseleave: function()
	    {
		    $( '.'+id).removeClass( 'borda' );
	    }
	}
	, '#lista_img img');

	$('.navbar-toggle').text('MENU');
	if (typeof paginacao != 'undefined'){
		paginacao = $('#paginacao').html();
		igual = '<div id="barra">  |  </div>';
		paginacao = paginacao.length;

		if(paginacao < 176) {
			$('#barra').hide();
		};
	}

	$('.menu-item-has-children').hover(
	  function () {
	    $(this).children('.dropdown-menu').addClass('ativo');
	 });
	 ////////galeria
	
	if ( $('.gallery').length > 0)
		$(".gallery").owlCarousel({
		     // Most important owl features
		     items : 4,
		     navigation : true,
		     pagination : false,

		     navigationText : ['<svg version="1.1" id="seta-esq" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" enable-background="new 0 0 451.846 451.847""> <path fill="#9EBA60" d="M106.405,203.554L300.692,9.274c12.358-12.365,32.396-12.365,44.75,0c12.354,12.354,12.354,32.391,0,44.743 L173.528,225.926L345.437,397.83c12.354,12.359,12.354,32.395,0,44.748c-12.354,12.359-32.391,12.359-44.75,0L106.4,248.293 c-6.177-6.18-9.262-14.271-9.262-22.366C97.138,217.829,100.229,209.732,106.405,203.554"/></svg>' ,'<svg id="seta-dir"width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" enable-background="new 0 0 451.846 451.847"><path fill="#9EBA60" d="M345.441,248.292l-194.288,194.28c-12.359,12.365-32.397,12.365-44.75,0 c-12.354-12.354-12.354-32.391,0-44.743L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748 c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284c6.177,6.18,9.262,14.271,9.262,22.366 C354.708,234.018,351.617,242.115,345.441,248.292"/></svg>'],
		 })
	
	 
	 $( '#modal-conteudo img' ).fitVids();
	 
	 $('.gallery-item a').on('click',function(e){
	 	e.preventDefault();
	 	$('#modal-conteudo #html').html('');
	 	var data = {
	 		'action': 'revela_foto',
	 	};
		$('#ajax-loader').fadeIn();
	 	data.num=parseInt($(this).attr("data-num"));
	 	data.tamanho=$('.gallery').attr('data-tamanho')-1;
		data.legenda=$(this).attr("data-legenda");
	 	data.endereco = $(this).attr('href');
	 		$('#fundo-modal').attr('modal-estado','ativo');
	 		$('#modal-conteudo').attr('modal-estado','ativo');
	 	console.log(data);
	 	$.post(odin_main.ajaxurl, data, function(response) {
			$('#ajax-loader').css('display','none');
		
	 		$('#modal-conteudo #html').html(response);
			$('#modal-conteudo #html').fadeIn();
			$('#modal-conteudo #html img').fadeIn();
			$('#legenda').fadeIn();
			
			
			
			$(' #botao-fechar').fadeIn();
	 	});
	 	$(' #botao-fechar, #fundo-modal').click(function(f) {
	 		console.log('passou')
	 		f.preventDefault();
	 		$('#fundo-modal').attr('modal-estado','inativo');
	 		$('#modal-conteudo').attr('modal-estado','inativo');
			$('#modal-conteudo #html').fadeOut();
			$(' #botao-fechar').fadeOut();
			$('#legenda').fadeOut();
			
			
	 	});
	 });
	 
	$('body').on('click','.pag-modal',function(e){
		$('#modal-conteudo #html img').fadeOut();
		$(' #botao-fechar').fadeOut();
		$('#legenda').fadeOut();
		$('#ajax-loader').css('display','block');
		
	 	e.preventDefault();
	 	var data = {
	 		'action': 'revela_foto',
	 	};
		console.log();
	 	data.num=parseInt($('a[data-num="'+$(this).attr('data-dest')+'"]').attr("data-num"));
	 	data.tamanho=$('.gallery').attr('data-tamanho')-1;
		data.legenda=$('a[data-num="'+$(this).attr('data-dest')+'"]').attr("data-legenda");
	 	data.endereco = $('a[data-num="'+$(this).attr('data-dest')+'"]').attr('href');
	 		$('#fundo-modal').attr('modal-estado','ativo');
	 		$('#modal-conteudo').attr('modal-estado','ativo');
	 	console.log(data);
	 	$.post(odin_main.ajaxurl, data, function(response) {
			$('#ajax-loader').css('display','none');
		
	 		$('#modal-conteudo #html').html(response);
			$('#modal-conteudo #html img').fadeIn();
			$(' #botao-fechar').fadeIn();
			$('#legenda').fadeIn();
			
	
	 	});
	 	$(' #botao-fechar, #fundo-modal').click(function(f) {
	 		console.log('passou')
	 		f.preventDefault();
	 		$('#fundo-modal').attr('modal-estado','inativo');
	 		$('#modal-conteudo').attr('modal-estado','inativo');
			$('#modal-conteudo #html').fadeOut();
			$(' #botao-fechar').fadeOut();
			$('#legenda').fadeOut();
			
	
	 	});
		
	 });
	if ( $('body').hasClass('archive'))
		console.log('tat')
		$('li.active').parent().addClass('ativo');
			
});
