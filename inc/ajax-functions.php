<?php

	add_action( 'wp_enqueue_scripts', 'ajax_localize', 1 );
	function ajax_localize(){
		wp_localize_script( 'odin-main', 'odin_main', array('ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	
	function filtra_cat(){
		wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
		$resposta = $_POST['meta'];//puxa os metas do ajax da forma meta_key:meta_value, meta_key:meta_value, 
		$args=array();
		$args['posts_per_page'] = 999;
		$args['paged'] = true;
		$args['post_type']= $resposta['post_type'];
		if ($resposta['term'] !=-1){
			$args['tax_query'][0]['taxonomy'] = $resposta['taxonomy'];
			$args['tax_query'][0]['field'] ='term_id';
			$args['tax_query'][0]['terms'] = array($resposta['term']);
		}
		
		$janelas_query = new WP_Query( $args );
		
		if ( $janelas_query->have_posts() ) {
			$count=1;
			while ( $janelas_query->have_posts() ) {
				$janelas_query->the_post();
				$titu =  get_the_title();
				$desc = get_the_content();
					$ajax_response['html'] .= '
					<li class="janela col-sm-4" id="cliente-'.$post->ID.'">
						<a href="'.get_the_permalink().'">
								'.get_the_post_thumbnail($post->ID, "janelas").'
									<h4>'.$titu.'</h4>
						</a>
					</li>
					';
					if ($count % 3 == 0){
						$ajax_response['html'] .='<div class="clearfix"></div>';
					}
				$count++;
				
				
			}//while
		} else {
			$ajax_response['html'] .='nopost';
			// no posts found
		}
		// $ajax_response['html'] ="teste";
		echo json_encode($ajax_response);
		wp_die();
		
	}
	
	add_action( 'wp_ajax_revela_foto', 'revela_foto' );
	add_action( 'wp_ajax_nopriv_revela_foto', 'revela_foto' );
	
	
	
	
	//////////////////////////////foto
	function revela_foto(){
		$num=$_POST['num'];
		if ($num !== "0"){
			echo '<a class="pag-modal esq" href="#" data-dest="'.($num-1).'" >
<svg version="1.1" id="seta-esq" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" enable-background="new 0 0 451.846 451.847""> <path class="esq-modal" fill="#fff" d="M106.405,203.554L300.692,9.274c12.358-12.365,32.396-12.365,44.75,0c12.354,12.354,12.354,32.391,0,44.743 L173.528,225.926L345.437,397.83c12.354,12.359,12.354,32.395,0,44.748c-12.354,12.359-32.391,12.359-44.75,0L106.4,248.293 c-6.177-6.18-9.262-14.271-9.262-22.366C97.138,217.829,100.229,209.732,106.405,203.554"/></svg>			</a>';
		}
		
		$end=$_POST['endereco'];
		echo '<img style="display:none" src='.$end.'>';
		echo '<p style="display:none" id="legenda">'.$_POST['legenda'].'</p>';
		if ($_POST['num'] !== $_POST['tamanho'] ){
					echo '<a class="pag-modal dir" href="#" data-dest="'.($num+1).'">
<svg id="seta-dir"width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847" enable-background="new 0 0 451.846 451.847"><path fill="#9EBA60" d="M345.441,248.292l-194.288,194.28c-12.359,12.365-32.397,12.365-44.75,0 c-12.354-12.354-12.354-32.391,0-44.743L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748 c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284c6.177,6.18,9.262,14.271,9.262,22.366 C354.708,234.018,351.617,242.115,345.441,248.292"/></svg>						</a>';
				}
		
		wp_die();
		
	}
	add_action( 'wp_ajax_filtra_cat', 'filtra_cat' );
	add_action( 'wp_ajax_nopriv_filtra_cat', 'filtra_cat' );