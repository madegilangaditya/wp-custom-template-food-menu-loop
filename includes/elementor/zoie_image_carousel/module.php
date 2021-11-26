<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Zoie_Image_Carousel_Widget extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', [ 'elementor-frontend' ], '1.8.1', true );
		wp_register_script( 'image-carousel-script', get_stylesheet_directory_uri() . '/includes/elementor/zoie_image_carousel/js/script.js', array( 'jquery' ), _S_VERSION, true );

		wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
		wp_register_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' );
	}

    public function get_script_depends() {
		return [ 'slick', 'image-carousel-script' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'slick-theme' ];
	}

	public function get_name() {
		return 'zoie_image_carousel';
	}

	public function get_title() {
		return __( 'Zoie Image Carousel', 'zoiecafe' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'zoie-widget' ];
	}

    protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

            $repeater = new \Elementor\Repeater();


            $repeater->add_control(
                'list_image',
                [
                    'label' => __( 'Choose Image', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $repeater->add_control(
                'list_title', [
                    'label' => __( 'Title', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'List Title' , 'zoiecafe' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'list_badge', [
                    'label' => __( 'Title Badge', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );


            // $repeater->add_control(
            //     'list_url',
            //     [
            //         'label' => __( 'Youtube Url', 'zoiecafe' ),
            //         'type' => \Elementor\Controls_Manager::URL,
            //         'placeholder' => __( 'https://www.youtube.com/watch?v=r2T-xP-bdOI', 'zoiecafe' ),
            //         'show_external' => true,
            //         'default' => [
            //             'url' => '',
            //             'is_external' => true,
            //             'nofollow' => true,
            //         ]
            //     ]
            // );
    

            $this->add_control(
                'list',
                [
                    'label' => __( 'Repeater List', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( 'Title #1', 'zoiecafe' ),
                        ],
                        [
                            'list_title' => __( 'Title #2', 'zoiecafe' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
                ]
            );

		$this->end_controls_section();

		// Image Style
        $this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'image_width',
                [
                    'label' => __( 'Width', 'zoiecafe' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 400,
                    ],
                    'selectors' => [
                        
                        '{{WRAPPER}} .zoie-carousel__item' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_height',
                [
                    'label' => __( 'Height', 'zoiecafe' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 400,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoie-image__carousel img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                ]
            );

			$this->add_responsive_control(
				'image_spacing',
				[
					'label' => __( 'Spacing', 'zoiecafe' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .zoie-carousel__item' => 'margin: 0 {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

        // Style Carousel Text
        $this->start_controls_section(
			'text_style_section',
			[
				'label' => __( 'Carousel Text', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'text_title_color',
                [
                    'label' => __( 'Text Title Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoie-carousel__text-content' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'carousel_text_typography',
                    'label' => __( 'Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoie-carousel__text-content',
                ]
            );

            $this->add_control(
                'text_badge_color',
                [
                    'label' => __( 'Text Badge Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoie-carousel__text-content span' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'carousel_badge_typography',
                    'label' => __( 'Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoie-carousel__text-content span',
                ]
            );

            $this->add_control(
                'text_box_color',
                [
                    'label' => __( 'Background Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoie-carousel__text-content' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => __( 'Text Box Padding', 'zoiecafe' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .zoie-carousel__text-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['list'] ):

			echo '<div class="zoie-image__carousel">';

				foreach ( $settings['list'] as $item ):?>
                    <div class="zoie-carousel__item elementor-repeater-item-<?php echo $item['_id']; ?> ">
                        <?php
                            echo '<img src="' . $item['list_image']['url'] . '">';
                        ?>
                        
                            <div class="zoie-carousel__text-content"><?php echo $item['list_title']; ?> <span class="zoie-carousel__text-badge"><?php if($item['list_badge'] != ''){ echo '[' .$item['list_badge']. ']'; } ?> </span></div>
                        
                    </div>
				<?php endforeach;

			echo '</div>';
			
		endif;
	}

}