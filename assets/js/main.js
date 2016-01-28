

jQuery(document).ready(function($) {
	window.onbeforeunload = function(){
		$('select option').css('visibility','hidden')
						  .prop('selected', function() {
		        return this.defaultSelected;
		    });
    	
	}
	$('.seletor-categoria').change(function(e){
	   	var meta = {};
	   	var data = {'action': 'filtra_cat'};
       	meta['post_type'] = $(this).attr('id');
		meta['term']=$( "select option:selected" ).attr('value');
		meta['taxonomy']=$(this ).attr('data-taxonomy');
		data.meta = meta;
	   	$.ajax({
			type: 'POST',
	  	 	url: odin_main.ajaxurl,
		   	data: data,
		   	dataType: 'json',
		   	complete: function(response){
				var obj = $.parseJSON(response.responseText);
				console.log(obj.html)
				if 	(meta['post_type'] =='projetos'){
					$('#lista_titulos').html(obj.html);
					$('#lista_img').html(obj.html1);
				}
				else{
					$('#conteudo-filtro').html(obj.html);
				}
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
	
});
