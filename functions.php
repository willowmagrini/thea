<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/inc/menu-walker.php';

require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
require_once get_template_directory() . '/core/classes/class-theme-options.php';
require_once get_template_directory() . '/core/classes/class-options-helper.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since  2.2.0
	 *
	 * @return void
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();
	if (is_single()) {
			wp_enqueue_script( 'owl-js',$template_url .'/inc/owl-carousel/owl-carousel/owl.carousel.js', array(), null, true );
			wp_enqueue_style( 'owl-style', $template_url .'/inc/owl-carousel/owl-carousel/owl.carousel.css', array(), null, 'all' );
			wp_enqueue_style( 'owl-theme', $template_url .'/inc/owl-carousel/owl-carousel/owl.theme.css', array(), null, 'all' );

		}
	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap.
	wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

	// General scripts.
	// FitVids.
	wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

	// Main jQuery.
	wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, false );

	// Grunt main file with Bootstrap, FitVids and others libs.
	// wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/plugins-support.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

// ajax
require_once get_template_directory() . '/inc/ajax-functions.php';



////////////////////////////////////////////////////////////////
////////////////Opcoes do tema////////////////
////////////////////////////////////////////////////////////////
$odin_theme_options = new Odin_Theme_Options( 
    'opcoes', // Slug/ID da página (Obrigatório)
    __( 'Opções do tema', 'thea' ), // Titulo da página (Obrigatório)
    'manage_options' // Nível de permissão (Opcional) [padrão é manage_options]
);
$odin_theme_options->set_tabs(
    array(
		array(
			'id' => 'config', // ID da aba e nome da entrada no banco de dados.
			'title' => __( 'Configurações', 'thea' ), // Título da aba.
		),
		array(
			'id' => 'socials', // ID da aba e nome da entrada no banco de dados.
			'title' => __( 'Social', 'thea' ), // Título da aba.
		),
		
    )
);
$odin_theme_options->set_fields(
    array(
        'config_section' => array(
            'tab'   => 'config', // Sessão da aba odin_general
            'title' => __( 'Imagem de fundo', 'thea' ),
            'fields' => array(
                array(
				    'id'          => 'bgimg', // Obrigatório
				    'label'       => __( 'Imagem de fundo', 'thea' ), // Obrigatório
				    'type'        => 'image', // Obrigatório
				    'default'     => '', // Opcional (deve ser o id de uma imagem em mídia)
				    'description' => __( 'escolha aqui a imagem para o fundo do site', 'thea' ), // Opcional
				),
				// opção de cor
				array(
				    'id'          => 'cor', // Obrigatório
				    'label'       => __( 'Cor principal', 'odin' ), // Obrigatório
				    'type'        => 'color', // Obrigatório
				    // 'attributes' => array(), // Opcional (atributos para input HTML/HTML5)
				    'default'     => '#ffffff', // Opcional (cor em hexadecimal)
				    'description' => __( 'Escolha a cor principal do site, ela ira afetar os escritos, a faixa do título, a linha do rodapé e os icones.', 'odin' ), // Opcional
				),
				array(
				    'id'          => 'contato', // Obrigatório
				    'label'       => __( 'Texto do formulario de contato', 'odin' ), // Obrigatório
				    'type'        => 'text', // Obrigatório
				    // 'attributes' => array(), // Opcional (atributos para input HTML/HTML5)
				)
            )
        ),
        'socials_section' => array(
            'tab'   => 'socials', // Sessão da aba odin_general
            'title' => __( 'Redes Sociais', 'odin' ),
            'fields' => array(
                array(
                    'id' => 'facebook',
                    'label' => __( 'Facebook', 'odin' ),
                    'type' => 'text',
                    'default' => '',
                ),
                array(
                    'id' => 'instagram',
                    'label' => __( 'Instagram', 'odin' ),
                    'type' => 'text'
                ),
            )
        ),
    )
);
function coloca_http($endereco){
	$http = substr ($endereco, 0 , 4);
	if ($http == 'http'){
		return $endereco;
	}
	else {
		return 'http://'.$endereco;
	}
}

////////////////////////////////////////////////////////////////
////////////////Opcoes do tema////////////////
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
////////////////cor de hex para rgba////////////////
////////////////////////////////////////////////////////////////
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = $r.','. $g.','.$b;
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
////////////////////////////////////////////////////////////////
////////////////cor de hex para rgba////////////////
////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////
////////////////font-awesome////////////////
////////////////////////////////////////////////////////////////


add_action('admin_init', 'prefix_enqueue_awesome');

add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
/**
 * Register and load font awesome CSS files using a CDN.
 *
 * @link   http://www.bootstrapcdn.com/#fontawesome
 * @author FAT Media
 */
function prefix_enqueue_awesome() {
	wp_enqueue_style( 'prefix-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.0.3' );
}

////////////////////////////////////////////////////////////////
////////////////font-awesome////////////////
////////////////////////////////////////////////////////////////

////////google-fonts
function load_fonts() {
            wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Roboto:300|900');
            wp_enqueue_style( 'googleFonts');
        }
    
    add_action('wp_print_styles', 'load_fonts');

//////////////////////google-fonts//////////////////////////
////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////
////////////////Custom post types////////////////
////////////////////////////////////////////////////////////////

////////////////Janela////////////////

function janela_cpt(){
	$janela = new Odin_Post_Type(
	    'Janela', // Nome (Singular) do Post Type.
	    'janelas' // Slug do Post Type.
	);
	$janela->set_labels(
	    array(
	        'menu_name' => __( 'Janelas', 'odin' ),
			'all_items' => __('Todas as Janelas', 'odin'),
	    	'add_new_item' => __('Adicionar nova', 'odin'),
			'add_new' => __('Adicionar nova', 'odin'),
			'all_items'=> __('Janelas', 'odin'),
			'view_item'=> __('Janelas', 'odin'),
			'search_items'=> __('Janelas', 'odin'),
			'new_item'=> __('Janelas', 'odin'),	
			'edit_item'=> __('Janelas', 'odin'),	
			'singular_name'=> __('Janela', 'odin'),	
			'name'=> __('Janelas', 'odin'),	
			
			)
	);
	$janela->set_arguments(
        array(
	        'taxonomies' => array('cat_janela'),
			'description' => __( 'Coisas que vejo, leio, visito, pesquiso. Coisas com as quais me encanto. Ou me espanto...' ),
		
		 	'menu_icon' => 'dashicons-screenoptions',
      		'supports' => array( 'title', 'editor', 'thumbnail' ),

    	)
	);
	
}
add_action( 'init', 'janela_cpt', 1 );

////////////////Projetos////////////////

 ////////////////Projetos////////////////

function projetos_cpt(){
	$projetos = new Odin_Post_Type(
	    'Projeto', // Nome (Singular) do Post Type.
	    'projetos' // Slug do Post Type.
	);
	$projetos->set_labels(
	    array(
	        'menu_name' => __( 'Projetos', 'odin' ),
			'all_items' => __('Todos os projetos', 'odin'),
	    	'add_new_item' => __('Adicionar novo', 'odin'),
			'add_new' => __('Adicionar novo', 'odin')
			)
	);
	$projetos->set_arguments(
        array(
	        'taxonomies' => array('cat_projeto'),
		 	'menu_icon' => 'dashicons-screenoptions',
      		'supports' => array( 'title', 'editor', 'thumbnail' ),
			'description' => __( 'Jardins, parques, praças, sítios... Conhecer o lugar, entender o que o cliente quer, do que gosta e do que precisa. Aí então, compor e propor uma paisagem nova!' ),

    	)
	);

}
add_action( 'init', 'projetos_cpt', 1 );

 ////////////////Viagens////////////////
 
 ////////////////Viagens////////////////

function viagem_cpt(){
	$viagem = new Odin_Post_Type(
	    'Viagens', // Nome (Singular) do Post Type.
	    'viagens' // Slug do Post Type.
	);
	$viagem->set_labels(
	    array(
	        'menu_name' => __( 'viagens', 'odin' ),
			'all_items' => __('Todas as viagens', 'odin'),
	    	'add_new_item' => __('Adicionar nova', 'odin'),
			'add_new' => __('Adicionar nova', 'odin')
			)
	);
	$viagem->set_arguments(
        array(
	        'taxonomies' => array('cat_viagem'),
		 	'menu_icon' => 'dashicons-admin-site',
      		'supports' => array( 'title', 'editor', 'thumbnail' ),
			'description' => __( 'Descobertas de outras paisagens. Umas próximas, outras distantes. Umas incríveis, outras estonteantes.' ),

    	)
	);

}
add_action( 'init', 'viagem_cpt', 1 );

////////////////Meu Jardim////////////////

////////////////Meu Jardim////////////////

function jardim_cpt(){
	$jardin = new Odin_Post_Type(
	    'Meu Jardim', // Nome (Singular) do Post Type.
	    'jardins' // Slug do Post Type.
	);
	$jardin->set_labels(
	    array(
			'name'=> __('Meus Jardins', 'odin'),
	        'menu_name' => __( 'Jardins', 'odin' ),
			'all_items' => __('Todos os Jardins', 'odin'),
	    	'add_new_item' => __('Adicionar novo', 'odin'),
			'add_new' => __('Adicionar novo', 'odin'),
			'singular_name'=> __('Meu Jardim', 'odin'),	
			'edit_item' => __('Meu Jardim', 'odin'),	
			
			
			)
	);
	$jardin->set_arguments(
        array(
	        'taxonomies' => array('cat_jardim'),
		 	'menu_icon' => 'dashicons-screenoptions',
      		'supports' => array( 'title', 'editor', 'thumbnail' ),
			'description' => __( 'O lugar onde faço minhas experiências, planto sementes vindas de longe, podo, adubo, transplanto e por aí afora. Criando uma paisagem rica em cores, formas, texturas e perfumes.<p>Entrem! Sintam-se em casa!</p>' ),

    	)
	);

}
add_action( 'init', 'jardim_cpt', 1 );

////////////////Janela////////////////
	///////muda icone

	function fontawesome_icon_dashboard() {
	   echo '<style type="text/css" media="screen">
	   			 .menu-icon-projetos .dashicons-before:before {
	   				content: "\f040"; 
				 	font-family: "FontAwesome" !important;
					font-size: 18px !important;
	     	</style>';
	   echo '<style type="text/css" media="screen">
	      			 .menu-icon-viagem .dashicons-before:before {
	      				content: "\f072"; 
	   			 	font-family: "FontAwesome" !important;
	   				font-size: 18px !important;
	        	</style>';

		echo '<style type="text/css" media="screen">
		   			 .menu-icon-meu_jardim .dashicons-before:before {
		   				content: "\f06c"; 
					 	font-family: "FontAwesome" !important;
						font-size: 18px !important;
		     	</style>';
	}

	add_action('admin_head', 'fontawesome_icon_dashboard');
	///////muda icone
	
	
////////////////////////////////////////////////////////////////
////////////////Custom post types////////////////
////////////////////////////////////////////////////////////////	

///////////////////////tyamanho do excerpt///////////////////
///////////////////////tyamanho do excerpt///////////////////
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
///////////////////////tyamanho do excerpt///////////////////
///////////////////////tyamanho do excerpt///////////////////


///////////////////formulario de contato/////////////////////
//[foobar]
function contato_shortcode(  ){
 	$form =  scf_html();
	return $form;
}
add_shortcode( 'formulario_contato', 'contato_shortcode' );



// add editor the privilege to edit theme

// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'manage_options' );
$role_object->remove_cap('edit_theme_options');



/////////////////////////////////////////////////////////////
////////////////////ocultando coisas no admin///////////////
/////////////////////////////////////////////////////////////
if( current_user_can('editor') && !current_user_can('administrator')) {
	add_action( 'admin_menu', 'my_remove_menu_pages' );

}
function my_remove_menu_pages() {
	
	remove_menu_page('tools.php');
	remove_menu_page('options-general.php');
	remove_menu_page('edit-comments.php');	
	remove_menu_page('edit.php');	
	remove_menu_page('upload.php');	
	remove_menu_page('index.php');	
	// remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
	remove_submenu_page( 'themes.php', 'customize.php' ); // hide the theme selection submenu
	remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the theme selection submenu
	remove_submenu_page( 'themes.php', 'nav-menus.php' ); // hide the theme selection submenu
}
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');  
	$wp_admin_bar->remove_menu('search');           // If you use w3 total cache remove the performance link
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
add_image_size( 'janelas', '270', '170', true );
add_image_size( 'viagens', '150', '150', true );
add_image_size( 'modal', '150', '150', true );


/////////////////////////////////////////////////////////////
	////////////////////ocultando coisas no admin///////////////
/////////////////////////////////////////////////////////////

	
	update_option( 'thumbnail_size_w', 300 );
	update_option( 'thumbnail_size_h', 300 );
	update_option( 'thumbnail_crop', 1 );
	
		register_taxonomy( 'cat_projeto', 'projeto', array( 'hierarchical' => true, 'label' => 'Categoria de Projetos ', 'query_var' => true, 'rewrite' => true ) );
		register_taxonomy( 'cat_janela', 'janela', array( 'hierarchical' => true, 'label' => 'Categoria de Janelas ', 'query_var' => true, 'rewrite' => true ) );
		register_taxonomy( 'cat_jardim', 'jardim', array( 'hierarchical' => true, 'label' => 'Categoria de Jardins ', 'query_var' => true, 'rewrite' => true ) );
		register_taxonomy( 'cat_viagem', 'viagem', array( 'hierarchical' => true, 'label' => 'Categoria de Viagem ', 'query_var' => true, 'rewrite' => true ) );
		
		
		
///////carrossel////
	// Custom filter function to modify default gallery shortcode output
	function my_post_gallery( $output, $attr ) {

		// Initialize
		global $post, $wp_locale;

		// Gallery instance counter
		static $instance = 0;
		$instance++;

		// Validate the author's orderby attribute
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
		}

		// Get attributes from shortcode
		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr ) );

		// Initialize
		$id = intval( $id );
		$attachments = array();
		if ( $order == 'RAND' ) $orderby = 'none';

		if ( ! empty( $include ) ) {

			// Include attribute is present
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

			// Setup attachments array
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}

		} else if ( ! empty( $exclude ) ) {

			// Exclude attribute is present 
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );

			// Setup attachments array
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		} else {
			// Setup attachments array
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}

		if ( empty( $attachments ) ) return '';

		// Filter gallery differently for feeds
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			return $output;
		}

		// Filter tags and attributes
		$itemtag = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$columns = intval( $columns );
		$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
		$float = is_rtl() ? 'right' : 'left';
		$selector = "gallery-{$instance}";
		$tamanho=count($attachments);

		// Filter gallery CSS
		$output = apply_filters( 'gallery_style', "
			
			<!-- see gallery_shortcode() in wp-includes/media.php -->
			<div data-tamanho=".$tamanho." id='$selector' class='gallery galleryid-{$id}'>"
		);

		// Iterate through the attachments in this gallery instance
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {

			// Attachment link
			$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false ); 
			$link = str_replace('<a','<a data-legenda="'.$attachment->post_excerpt.'" data-num="'.$i.'"',$link);
		    
			// Start itemtag
			$output .= "<{$itemtag} class='gallery-item' >";

			// icontag
			$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";


			// End itemtag
			$output .= "</{$itemtag}>";

			// Line breaks by columns set
			if($columns > 0 && ++$i % $columns == 0) $output .= '';

		}

		// End gallery output
		$output .= "
			<br style='clear: both;'>
		</div>\n";

		return $output;

	}

	// Apply filter to default gallery shortcode
	add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
	
	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function prefix_disable_wporg_request( $r, $url ) {

		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
				return $r;
			}

			// Decode the JSON response
			$themes = json_decode( $r['body']['themes'] );

			// Remove the active parent and child themes from the check
			$parent = get_option( 'template' );
			$child = get_option( 'stylesheet' );
			unset( $themes->themes->$parent );
			unset( $themes->themes->$child );

			// Encode the updated JSON response
			$r['body']['themes'] = json_encode( $themes );

			return $r;
	}
	add_filter( 'http_request_args', array( $this, 'prefix_disable_wporg_request' ), 5, 2 );