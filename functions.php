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

function itpharma_wptuts_scripts_basic()  
{  
	wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery-3.4.0.min.js', '', '3.4.0' );  
    wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'bootstrapminjs', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', '', '4.3.1' );  
    wp_enqueue_script( 'bootstrapminjs' );
	
	wp_register_style( 'bootstrapmincss', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrapmincss' );
	
	wp_register_style( 'bootstrap-gridmincss', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrap-gridmincss' );
	
	wp_register_style( 'bootstrap-rebootmincss', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrap-rebootmincss' );
}  
add_action( 'wp_enqueue_scripts', 'itpharma_wptuts_scripts_basic' );

function itpharma_delete_junk_from_header() {
    remove_action( 'wp_head', 'feed_links', 2 ); // Удаляет ссылки RSS-лент записи и комментариев
    remove_action( 'wp_head', 'feed_links_extra', 3 ); // Удаляет ссылки RSS-лент категорий и архивов
    
    remove_action( 'wp_head', 'rsd_link' ); // Удаляет RSD ссылку для удаленной публикации
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Удаляет ссылку Windows для Live Writer
    
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); // Удаляет короткую ссылку
    remove_action( 'wp_head', 'wp_generator' ); // Удаляет информацию о версии WordPress
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Удаляет ссылки на предыдущую и следующую статьи
    
    // отключение WordPress REST API
    remove_action( 'wp_head', 'rest_output_link_wp_head' ); 
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
}
add_filter( 'after_setup_theme', 'itpharma_delete_junk_from_header' );

function itpharma_theme_support() {
	//добавляю кастомный лого
	add_theme_support( 'custom-logo', [
		'height'      => 30,
		'width'       => 30,
		'flex-width'  => false,
		'flex-height' => false,
		'header-text' => 'ITPharma',
	] );
	//добавляю кастомный фон
	add_theme_support( 'custom-background' );
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => 'repeat', // повторять
		'default-position-x'     => 'left', // выровнять по левому краю
		'default-attachment'     => 'fixed', // фон прокручивается со страницей
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
	//добавляю меню
	register_nav_menu( 'primary', 'Основное меню' );
}
add_filter( 'after_setup_theme', 'itpharma_theme_support' );

//добавляю настройки кастомайзера темы
function itpharma_customize_register($wp_customize) {
	//имя секции настроек
	$wp_customize->add_section( 'itpharma_customizer' , array(
		'title'      => __('Настройка темы','mytheme'),
		'priority'   => 30,
	));
	//стиль шапки
	$wp_customize->add_setting( 'itpharma_header_style' , array(
		'default' => 'dark',
	));
	//контроллер стиля шапки
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'itpharma_header_style_type', 
		array(
			'label'    => __( 'Стиль шапки', 'itpharma' ),
			'section'  => 'itpharma_customizer',
			'settings' => 'itpharma_header_style',
			'type'     => 'radio',
			'choices'  => array(
				'dark'  => 'Темный фон',
				'light' => 'Светлый фон',
			),
		)
	));
	//цвет шапки
	$wp_customize->add_setting( 'itpharma_header_background' , array(
		'default' => '#007bff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	//контроллер цвета шапки
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'itpharma_header_background_color', 
		array(
			'label'      => __( 'Цвет шапки', 'itpharma' ),
			'section'    => 'itpharma_customizer',
			'settings'   => 'itpharma_header_background',
				'priority'   => 1
		)
	));
	//код внутри блока <HEAD></HEAD>
	$wp_customize->add_setting( 'itpharma_head_code' , array(
		'default' => '',
	));
	//контроллер кода внутри блока <HEAD></HEAD>
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'itpharma_head_code_text', 
		array(
			'label'    => __( 'HTML-код внутри блока <HEAD></HEAD>', 'itpharma' ),
			'section'  => 'itpharma_customizer',
			'settings' => 'itpharma_head_code',
			'type'     => 'textarea',
		)
	));
	//код в шапке
	$wp_customize->add_setting( 'itpharma_header_code' , array(
		'default' => '',
	));
	//контроллер кода в шапке
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'itpharma_header_code_text', 
		array(
			'label'    => __( 'HTML-код в шапке (над меню, сразу после <BODY>)', 'itpharma' ),
			'section'  => 'itpharma_customizer',
			'settings' => 'itpharma_header_code',
			'type'     => 'textarea',
		)
	));
	//код в подвале
	$wp_customize->add_setting( 'itpharma_footer_code' , array(
		'default' => '',
	));
	//контроллер кода в подвале
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'itpharma_footer_code_text', 
		array(
			'label'    => __( 'HTML-код в подвале (перед </BODY>)', 'itpharma' ),
			'section'  => 'itpharma_customizer',
			'settings' => 'itpharma_footer_code',
			'type'     => 'textarea',
		)
	));
}
add_action( 'customize_register', 'itpharma_customize_register' );

//виджеты
function arphabet_widgets_init() {
	register_sidebar( array(
		'name'          => 'Виджет перед меню',
		'id'            => 'itpharma-before-menu-widget',
		'before_widget' => '<div class="itph_wdgt itph_wdgt_mn" id="itph_wdgt_mn_bef">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Виджет после меню (перед постом)',
		'id'            => 'itpharma-after-menu-widget',
		'before_widget' => '<div class="itph_wdgt itph_wdgt_mn" id="itph_wdgt_mn_aftr">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Виджет перед подвалом (после поста)',
		'id'            => 'itpharma-before-bottom-widget',
		'before_widget' => '<div class="itph_wdgt itph_wdgt_bt" id="itph_wdgt_bt_bef">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Виджет в правом нижнем углу (поверх страницы)',
		'id'            => 'itpharma-over-window-widget',
		'before_widget' => '<div class="itph_wdgt" id="itph_wdgt_ovr_wndw">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );