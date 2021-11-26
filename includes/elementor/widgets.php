<?php 
/**
 * Register New Category Widget for Elementor
 */
function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'zoie-widget',
        [
            'title' => __( 'Zoie Cafe Widget', 'zoiecafe' ),
            'icon' => 'fa fa-plug'
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

class Zoie_Custom_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once( 'zoie_food_menu_listing/module.php' );
		require_once( 'zoie_image_carousel/module.php' );
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zoie_Food_Menu_Listing_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zoie_Image_Carousel_Widget());
	}

}

add_action( 'init', 'zoie_elementor_init' );
function zoie_elementor_init() {
	Zoie_Custom_Elementor_Widgets::get_instance();
}
