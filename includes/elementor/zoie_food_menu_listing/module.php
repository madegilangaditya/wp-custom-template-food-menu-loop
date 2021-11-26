<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Zoie_Food_Menu_Listing_Widget extends Widget_Base {

    public function get_name() {
		return 'zoie_food_menu_listing';
	}

	public function get_title() {
		return __( 'Zoie Food Menu Listing', 'zoiecafe' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'zoie-widget' ];
	}

    protected function _register_controls() {
        
        $this->start_controls_section(
			'query_options',
			[
				'label' => __( 'Query', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

            $this->add_control(
                'source',
                [
                    'label' => __( 'Source', 'zoiecafe' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'latest' => __( 'Latest', 'zoiecafe' ),
                        // 'page_query' => __( 'Page Query', 'zoiecafe' ),
                    ],
                    'default' => 'latest',
                    'save_default' => true,
                ]
            );

			// $this->add_control(
			// 	'posts_per_page',
			// 	[
			// 		'label' => __( 'Posts Per Page', 'zoiecafe' ),
			// 		'type' => \Elementor\Controls_Manager::NUMBER,
			// 		'min' => 1,
			// 		'max' => 50,
			// 		'step' => 1,
			// 		'default' => 3,
			// 		'dynamic'       => array(
			// 			'active' => true,
			// 		),
			// 	]
			// );

			// $this->add_control(
			// 	'number_post',
			// 	[
			// 		'label' => __( 'Number Post', 'zoiecafe' ),
			// 		'type' => \Elementor\Controls_Manager::NUMBER,
			// 		'min' => 1,
			// 		'max' => 200,
			// 		'step' => 1,
			// 		'default' => 3,
			// 		'dynamic'       => array(
			// 			'active' => true,
			// 		),
			// 	]
			// );

            $this->add_control(
                'pdf_link',
                [
                    'label' => __( 'PDF Link', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'zoiecafe' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'pdf_text',
                [
                    'label' => __( 'PDF Download Text', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Download PDF Menu', 'zoiecafe' ),
                    'placeholder' => __( 'Type your text here', 'zoiecafe' ),
                ]
            );

            $this->add_control(
                'featured_image',
                [
                    'label' => __( 'Choose Featured Image', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

		$this->end_controls_section();

        // Style Box
        $this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => __( 'Padding', 'zoiecafe' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-menu-listing-wrapper__all' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'box_background',
                    'label' => __( 'Background', 'zoiecafe' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-listing-wrapper__all',
                ]
            );

        $this->end_controls_section();

        // Style Food Menu Categories
        $this->start_controls_section(
			'food_menu_cat_style_section',
			[
				'label' => __( 'Food Menu Categories', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'food_menu_cat_typography',
                    'label' => __( 'Text Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-type-item a',
                ]
            );

            $this->add_control(
                'food_menu_cat_divider_color',
                [
                    'label' => __( 'Divider Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-type-item' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'food_menu_cat_style_tabs'
            );

                $this->start_controls_tab(
                    'food_menu_cat_tab',
                    [
                        'label' => __( 'Normal', 'zoiecafe' ),
                    ]
                );

                    $this->add_control(
                        'food_menu_cat_color',
                        [
                            'label' => __( 'Text Color', 'zoiecafe' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .zoiecafe-food-type-item a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'food_menu_cat_hover_tab',
                    [
                        'label' => __( 'Hover', 'zoiecafe' ),
                    ]
                );

                    $this->add_control(
                        'food_menu_cat_hover_color',
                        [
                            'label' => __( 'Text Color', 'zoiecafe' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .zoiecafe-food-type-item:hover a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_responsive_control(
                'food_menu_cat_wrapper_spacing',
                [
                    'label' => __( 'Spacing Bottom', 'zoiecafe' ),
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
                        '{{WRAPPER}} .zoiecafe-food-menu-type-listing-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'food_menu_cat_wrapper_space_between',
                [
                    'label' => __( 'Space Between', 'zoiecafe' ),
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
                        '{{WRAPPER}} .zoiecafe-food-type' => 'column-gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'food_menu_cat_icon_width',
                [
                    'label' => __( 'Icon Width', 'zoiecafe' ),
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
                        
                        'size' => 'auto',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-type-item img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'food_menu_cat_icon_height',
                [
                    'label' => __( 'Icon Height', 'zoiecafe' ),
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
                        'size' => 'auto',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-type-item img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Food menu
        $this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Food Menu', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => __( 'Title Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-listing__title',
                ]
            );

            $this->add_control(
                'title_badge_color',
                [
                    'label' => __( 'Title Badge Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__eat-style' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'text_badge_typography',
                    'label' => __( 'Title Badge Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-listing__eat-style',
                ]
            );

            $this->add_responsive_control(
                'title_spacing',
                [
                    'label' => __( 'Title Spacing', 'zoiecafe' ),
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
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'food_menu_wrapper_spacing',
                [
                    'label' => __( 'Wrapper Spacing', 'zoiecafe' ),
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
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Price Item
        $this->start_controls_section(
			'price_style_section',
			[
				'label' => __( 'Price', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'price_color',
                [
                    'label' => __( 'Text Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__price' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_text_typography',
                    'label' => __( 'Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-listing__price',
                ]
            );

        $this->end_controls_section();

        // Content Item
        $this->start_controls_section(
			'content_item_style_section',
			[
				'label' => __( 'Content Item', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'content_item_color',
                [
                    'label' => __( 'Text Color', 'zoiecafe' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .zoiecafe-food-menu-listing__content-item' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_item_text_typography',
                    'label' => __( 'Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-listing__content-item',
                ]
            );

        $this->end_controls_section();

        // PDF file Item Styling
        $this->start_controls_section(
			'pdf_file_style_section',
			[
				'label' => __( 'PDF Download', 'zoiecafe' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->start_controls_tabs(
                'pdf_file_style_tabs'
            );

                $this->start_controls_tab(
                    'pdf_file_color_tab',
                    [
                        'label' => __( 'Normal', 'zoiecafe' ),
                    ]
                );

                    $this->add_control(
                        'pdf_file_color',
                        [
                            'label' => __( 'Text Color', 'zoiecafe' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .zoiecafe-food-menu-download-wrap a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'padf_file_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'zoiecafe' ),
                    ]
                );

                    $this->add_control(
                        'pdf_file_hover_color',
                        [
                            'label' => __( 'Text Color', 'zoiecafe' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .zoiecafe-food-menu-download-wrap a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
            $this->end_controls_tabs();

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'pdf_file_text_typography',
                    'label' => __( 'Typography', 'zoiecafe' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .zoiecafe-food-menu-download-wrap a',
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
		$source	= $settings['source'];
		// $posts_per_page	= $settings['posts_per_page'];
		// $numberposts = $settings['number_post'];
        $pdftext = $settings['pdf_text'];
        $pdflink = $settings['pdf_link']['url']; 
        $featured_img = $settings['featured_image']['url']; 

        if( $source == "latest" ) {

            $args = array(
                'post_type' => 'food-menu',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                // 'numberposts' => $numberposts,
                'order' => 'ASC',
            );

        }
        // else if( $source == "page_query" ) {

        //     global $wp_query;
		// 	$args = array(
        //         'post_type' 		=> 'food-menu',
        //         'post_status' => 'publish',
		// 		'posts_per_page'	=> $posts_per_page,
		// 		'numberposts'		=> $numberposts,
		// 	);
		// 	$args = array_merge( $wp_query->query_vars, $args );

        // }

        $posts = new \WP_Query( $args );

        if( $posts->have_posts() ) { ?>
        <div class="zoiecafe-food-menu-listing-wrapper__all">
            <div class="zoiecafe-food-menu-type-listing-wrapper">
                <div class="zoiecafe-food-menu-type-listing-item">
                    <ul class="zoiecafe-food-type">
                        <?php 
                            $terms = get_terms(array(
                                'taxonomy' => 'food_type',
                                'orderby' => 'term_id', 
                                'hide_empty' => false
                            )); 
                        ?>
                        <?php
                            foreach($terms as $term):
                                $term_icon = get_field( 'food-type-icon', $term );
                                $term_icon_active = get_field( 'food-type-icon_active', $term );
                        ?>
                            <li class="zoiecafe-food-type-item <?php echo $post_id; ?>" data-set="<?php echo $term->term_id;?> ">
                                [ <a><?php echo $term->name;?> 
                                <?php
                                    if($term_icon != '') {
                                        echo  '<span><img class="img-normal" src="'.$term_icon.'" alt=""> <img class="img-hover" src="'.$term_icon_active.'" alt=""></span>';
                                    }
                                    
                                ?></a> ]
                            </li> 
                        <?php endforeach; ?>               
                        <?php    
                            wp_reset_postdata();
                        ?>
                    </ul>
                </div>
                <div class="zoiecafe-food-menu-download-wrap">
                    <a href="<?php echo $pdflink; ?>"><?php echo $pdftext; ?></a>                    
                </div>   
            </div>

            <div class="zoiecafe-food-menu-listing-wrapper" data-ppg="<?php echo $posts_per_page; ?>" data-paged="1" data-pages="<?php echo $posts->max_num_pages; ?>" data-query='<?php echo json_encode( $posts->query_vars ); ?>'>
                <div class="zoiecafe-food-menu-listing-wrapper__item">
                    <?php
                    // $i = 1;
                    // $length = count($posts);
                    // $max_col = 7;
                    // $j = 1;
                     
                    while( $posts->have_posts() ) {
                        $posts->the_post();
                        
                            // if($i % $max_col == 1){
                            //     echo '<div id="'. $j .'"class="zoiecafe-food-menu-listing-wrapper__item">'. "\xA";
                            //     $j++;
                            // }
                            get_template_part( 'template-parts/food-menu', 'loop' );

                            // if($i % $max_col == 0){
                            //     echo  "\xA".'</div>';
                            // } 
                            // $i++;
                        
                        
 
                    } wp_reset_postdata();
                    ?>
                </div>
                
            </div>
            <div class="zoiecafe-food-menu_featured-image">
                <?php if($featured_img != '' ){
                        echo '<img src="' . $featured_img . '">';        
                    } 
                ?>
            </div>
        </div>
        
        
        <?php } else {

            echo __( 'No Food Menu(s) found.', 'zoiecafe' ); 
            
        }

    }

}