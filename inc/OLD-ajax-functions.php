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
				if ($args['post_type']=='janelas'){
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
				}
				else if ($args['post_type']=='jardins'){
					$ajax_response['html'] .= '
					<li class="jardim col-sm-2" id="id-'.$post->ID.'">
						<a href="'.get_the_permalink().'">
								'.get_the_post_thumbnail($post->ID, "thumbnail").'
						</a>
					</li>
					';
					if ($count % 6 == 0){
						$ajax_response['html'] .='<div class="clearfix"></div>';
					}
				}
				
				else if ($args['post_type']=='viagens'){
					$ajax_response['html'] .= '
					<li class="viagem col-sm-12 " id="cliente-'.$post->ID.'">
						<a href="'.get_the_permalink().'">
							<div class=" thumb_viagem">
						
								'.get_the_post_thumbnail($post->ID, "viagens").'
							</div>
							<div class="viagem_div">
								<h4>'.$titu.'</h4>
								<p>'.get_the_excerpt().'</p>
							</div>
						</a>
					</li>';
					
						
				}
				else if($args['post_type']=='projetos'){
					$titu =  get_the_title();
					global $post; 
					$slug = $post->post_name;
					$desc = get_the_content();
					$lista_titulos .= "<li ><a href=' ".get_the_permalink()."'><h4 class='".$slug."'>".get_the_title()."</h4></a></li>";
					$lista_img .="<li class=' projeto col-sm-4 ' id='cliente-".$post->ID."'><a href='".get_the_permalink()."'>".get_the_post_thumbnail($post->ID, 'thumbnail',array('id'	=> $slug, 'class'=>'attachment-post-thumbnail')
					)."</a></li>";
					$ajax_response['html']=	$lista_titulos;
					$ajax_response['html1']=$lista_img;
					
				}
				
			}//while
		} else {
			$ajax_response['html'] .='nopost';
			// no posts found
		}
		// $ajax_response['html'] ="teste";
		echo json_encode($ajax_response);
		wp_die();
		
	}
	
	add_action( 'wp_ajax_filtra_cat', 'filtra_cat' );
	add_action( 'wp_ajax_nopriv_filtra_cat', 'filtra_cat' );