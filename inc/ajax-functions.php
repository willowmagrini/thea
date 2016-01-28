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
		$end=$_POST['endereco'];
		echo '<img src='.$end.'>';
		wp_die();
		
	}
	add_action( 'wp_ajax_filtra_cat', 'filtra_cat' );
	add_action( 'wp_ajax_nopriv_filtra_cat', 'filtra_cat' );