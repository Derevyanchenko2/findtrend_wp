<?php

// Автоматически определяем версию темы
define('FINDTREND_VERSION', wp_get_theme()->get('Version'));

/**
 * Настройка темы
 */
function findtrend_setup() {
    // Локализация
    load_theme_textdomain('findtrend', get_template_directory() . '/languages');

    // Поддержка <title>
    add_theme_support('title-tag');

    // Поддержка миниатюр (и для страниц тоже)
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // Регистрация меню
    // register_nav_menus([
    //     'primary' => esc_html__('Primary Menu', 'findtrend'),
    //     'footer'  => esc_html__('Footer Menu', 'findtrend'),
    // ]);

    // Поддержка логотипа
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Поддержка широких изображений в Gutenberg
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'findtrend_setup');

/**
 * Подключение стилей и скриптов
 */
add_action( 'wp_enqueue_scripts', function(){
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@500;700&family=Roboto:wght@400&display=swap', array(), null );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

    wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true );
    wp_enqueue_script( 'jquery-main', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true );
    wp_enqueue_script( 'sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), null, true );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array('swiper'), '1.0.0', true );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/ajax-form-handler.js', array('swiper'), '1.0.0', true );
      
    // Передаем admin-ajax URL в JavaScript
      wp_localize_script('modal-form', 'myAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php')
    ));

});

/**
 * Регистрация header
 */
function register_my_menus() {
    register_nav_menus([
        'header_menu' => 'Header Menu',
        'burger_menu' => 'Burger Menu',
        'footer_menu' => 'Footer Menu',
    ]);
}
add_action('after_setup_theme', 'register_my_menus');



/**
 * Регистрация боковой панели (виджеты)
 */
function findtrend_widgets_init() {
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'findtrend'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Добавьте сюда виджеты.', 'findtrend'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'findtrend_widgets_init');

/**
 * Разрешаем загрузку SVG в WordPress
 */
function findtrend_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'findtrend_mime_types');

function create_package_post_type() {
    register_post_type('packages', [
        'labels' => [
            'name' => 'Тарифы',
            'singular_name' => 'Тариф',
            'add_new' => 'Добавить тариф',
            'add_new_item' => 'Добавить новый тариф',
            'edit_item' => 'Редактировать тариф',
            'new_item' => 'Новый тариф',
            'view_item' => 'Просмотреть тариф',
            'search_items' => 'Найти тарифы',
            'not_found' => 'Тарифы не найдены',
            'not_found_in_trash' => 'В корзине нет тарифов',
            'parent_item_colon' => '',
            'all_items' => 'Все тарифы',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-awards', // Значок в меню
        'supports' => ['title', 'editor'], // Поддержка названия и контента
        'rewrite' => ['slug' => 'packages'],
        'show_in_rest' => true, // Для работы с блоками Gutenberg
    ]);
}
add_action('init', 'create_package_post_type');


function create_custom_post_type_requests() {
    register_post_type('requests',
        array(
            'labels' => array(
                'name' => 'Заявки',
                'singular_name' => 'Заявка'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'requests'),
            'show_in_rest' => true, // Если нужно отображение в блоке редактора
            'supports' => array('title', 'editor')
        )
    );
}
add_action('init', 'create_custom_post_type_requests');


// NOTE: 8 - before `wp_print_head_scripts`
add_action( 'wp_head', 'myajax_data', 8 );
function myajax_data(){
	$data = [
		'url' => admin_url( 'admin-ajax.php' ),
	];
	?>
	<script id="myajax_data">
		window.myajax = <?= wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ?>
	</script>
	<?php
}

/**
 * 
 * Handle Modal Form, Send email and create post to requests with updating acf fields
*/

add_action('wp_ajax_submit_request', 'handle_my_form_submission');
add_action('wp_ajax_nopriv_submit_request', 'handle_my_form_submission');

function handle_my_form_submission() {
  

    $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $tariff_name = isset( $_POST['tariff_name'] ) ? sanitize_textarea_field( $_POST['tariff_name'] ) : '';


    if ( empty( $name ) && empty( $email ) && empty( $tariff_name ) ) {
        wp_send_json_error( array(
            'message' => 'Please fill in all required fields and accept the privacy policy.'
        ) );
    }

    $to = get_option( 'admin_email' );
    $subject = 'Нове надсилання контактної форми від ' . $email;
    $body = "Name: $name\nEmail: $email\nSelected_package: $tariff_name";
    $headers = array ( 'Content-Type: text/plain; charset=UTF-8' );

    wp_mail( $to, $subject, $body, $headers );

   $post_id = wp_insert_post(array(
        'post_type'    => 'requests',
        'post_title'   => 'Нове надсилання контактної форми від ' . $email,
        'post_status'  => 'publish',
    ));

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 
            'message' => $post_id->get_error_message() 
        ) );
    } else {
        update_field( 'name', $name, $post_id );
        update_field( 'email', $email, $post_id );
        update_field( 'selected_package', $tariff_name, $post_id );

        wp_send_json_success();
    }
}

