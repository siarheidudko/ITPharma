<?php
/**
 * Основная тема для сайта itpharma.by
 *
 * @package ITPharma
 * @subpackage ITPharma
 * @since 1.0
 * @version 1.0
 * @author Siarhei Dudko
 * @license MIT
 */
?>
<!DOCTYPE html>
<html><head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" />
	<title><?php echo get_bloginfo("description") . ' - ' . get_page_by_path(get_page_uri())->post_title; ?></title>
	<?php wp_head() ?>
	<style type="text/css">
		body{ <?php 
			$backgroundimg = get_background_image();
			$backgroundcolor = get_background_color();
			if($backgroundcolor){
				echo 'background-color: #'.$backgroundcolor.';';
			}
			if($backgroundimg){
				echo 'background-image:url('.$backgroundimg.')';
			}
		?> }
	</style>
	<?php 
		$headercode = get_theme_mod('itpharma_head_code');
		if($headercode)
			echo $headercode;
	?>
</head>
<body  <?php body_class() ?>>
<?php if(is_active_sidebar('itpharma-before-menu-widget')) { dynamic_sidebar( 'itpharma-before-menu-widget' ); } ?>
<?php 
	$headercode = get_theme_mod('itpharma_header_code');
	if($headercode)
		echo $headercode;
?>
<nav class="navbar navbar-expand-lg <?php 
	$headerstyle = get_theme_mod('itpharma_header_style');
	switch($headerstyle){
		case 'dark':
			echo 'navbar-dark';
			break;
		case 'light':
			echo 'navbar-light';
			break;
		default:
			echo 'navbar-light';
			break;
	}
?>" style="z-index: 1000;<?php 
	$headercolor = get_theme_mod('itpharma_header_background');
	if($headercolor){ echo 'background-color: '.$headercolor.';'; } 
?>" aria-label="<?php esc_attr_e( 'Основное меню', 'itpharma' ); ?>">
	<a class="navbar-brand" href="#"><?php 
		$logotext = get_bloginfo("name");
		if(has_custom_logo()){
			$imglink = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			echo '<img src="'.$imglink[0].'" width="30" height="30" alt="">';
		}
		if($logotext){
			echo $logotext;
		} else {
			echo 'Логотип';
		}
	?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
    </button>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
			<?php
				$menu = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
				foreach( $menu as $page ){ 
					if(get_permalink() == ($page->url)){
						echo '<li class="nav-item active"><a class="nav-link" href="'.$page->url.'">'.esc_html($page->title).'<span class="sr-only">(current)</span></a></li>';
					} else {
						echo '<li class="nav-item"><a class="nav-link" href="'.$page->url.'">'.esc_html($page->title).'</a></li>';
					}
				}
			?>
		</ul>
	</div>
</nav>
<?php if(is_active_sidebar('itpharma-after-menu-widget')) { dynamic_sidebar( 'itpharma-after-menu-widget' ); } ?>