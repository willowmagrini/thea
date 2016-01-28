<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

	<?php
		$odin_general_opts = get_option( 'config' );
		$corex = $odin_general_opts['cor'];
		$cor = hex2rgb($corex);?>
<div id="secondary" class="widget-area col-sm-3 " role="complementary">
	<header  id="header" role="banner">
			
				<?php
					$header_image = get_header_image();
					if ( ! empty( $header_image ) ) :
				?>
			<div id="faixa">
				<a id="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" height="<?php esc_attr_e( $header_image->height ); ?>" width="<?php esc_attr_e(
				 $header_image->width ); ?>" alt="" /></a>
				<?php endif; ?>
				
			</div ><!--faixa-->
			<div style="border-color: transparent transparent 
				<?php
					echo "rgba(".$cor.",1)";
				?>
				" class="r-triangle-bottom">
			</div>
			<div style="border-color: 
				<?php
					echo "rgba(".$cor.",1)";
				?>
				transparent transparent 
				" class="r-triangle-top">
			</div>
		
		
	</header><!-- #header -->
	<div class="clearfix"></div>
	<nav id="main-navigation" class="navbar navbar-default" role="navigation">
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'odin' ); ?>"><?php _e( 'Skip to content', 'odin' ); ?></a>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
			<span class="sr-only"><?php _e( 'Toggle navigation', 'odin' ); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php /*

			<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

			*/ ?>
		</div>

		<div class="collapse navbar-collapse navbar-main-navigation">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-menu',
						'depth'          => 2,
						'container'      => false,
						'menu_class'     => 'nav ',
						'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
						'walker'         => new willow_Bootstrap_Nav_Walker()
					)
				);
			?>
		</div><!-- .navbar-collapse -->
	</nav><!-- #main-menu -->
	<?php
		$odin_general_opts = get_option( 'socials' );

		$face = $odin_general_opts['facebook'];
		$inst = $odin_general_opts['instagram'];
		$face = coloca_http($face);
		$inst = coloca_http($inst);
	?>
	<div id="social" class="absolute">
		<a target=_blank href="<?php echo $face?>">
			<i class="fa fa-facebook-square  fa-3x">
				
			</i>
		</a>
		<a target=_blank href="<?php echo $inst?>">
			<i style="" class="fa fa-instagram  fa-3x">
			</i>
		</a>
		<form id="busca-form" method="get"  action="<?php echo get_site_url();?>/" role="search">
			<div id='busca'>
				<input name='s' id="inputbusca" placeholder="Busca..."style="color:<?php echo 'rgba('.$cor.',1)'?>;	'border-color:<?php echo 'rgba('.$cor.',1)'?>" type="text">
				
				<button type="submit" style="color:#ffffff;background-color:<?php echo 'rgba('.$cor.',1)'?>"class="fa fa-search"></button>
			</div>

		</form>
	</div><!--social-->
	<div class="clearfix"></div>
	
	
	
  
</div><!-- #secondary -->
