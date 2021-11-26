<?php
$post_id = get_the_ID();
$post_terms = get_the_terms( $post_id, 'food_type' ); ?>

<div class="zoiecafe-food-menu-listing__item zoiecafe-food <?php foreach($post_terms as $terms) : echo strtolower($terms->slug). ' '; endforeach; ?> zoiecafe-food-menu-listing__item-<?php echo $post_id; ?> zoiecafe-food-type-<?php echo $terms->term_id; ?>">
    
        <div class="zoiecafe-food-menu-listing-wrapper__content">
            <h6 class="zoiecafe-food-menu-listing__title">
                <?php the_title(); ?>
                <div class="zoiecafe-food-menu-listing__eat-style">
                <?php if(get_field( 'eat_style', $post_id )): ?>    
                [ 
                    <?php 
                        $i=1;
                        $length = count(get_field( 'eat_style', $post_id ));
                    ?>

                    
                    <?php foreach(get_field( 'eat_style', $post_id ) as $result):
                            echo '<span class="' .$result .'"> ' .$result; 
                    ?>
                    <?php
                        if($i===$length) {
                            echo ' ';
                        } else{
                            echo ',';
                        } ;
                        echo ' </span>';
                        $i++;      

                        endforeach;
                     
                    ?>
                    ]
                <?php endif; ?>
                </div>
            </h6>
            <div class="zoiecafe-food-menu-listing__content-item"><?php the_content( ); ?></div>
        </div>
    
        <div class="zoiecafe-food-menu-listing-wrapper__price">
            <p class="zoiecafe-food-menu-listing__price"><?php if(get_field( 'price', $post_id )) : echo '$' .get_field( 'price', $post_id ); endif;?></p>
        </div>

</div>