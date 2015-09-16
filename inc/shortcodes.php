<?php


class SliderDocsShortcodeS {

  function __construct() {
    add_shortcode('swiper-docs-s', array($this, 'shortcode_callback'));
    add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_cb'));
    add_action('wp_head', array($this, 'hook_css'));
  }


  function shortcode_callback($atts){

    extract( shortcode_atts( array(
        'post_type'       => 'docs-s',
        'numberposts'     => 7,
      	'offset'          => 0,
      	'class_wrapper'   => 'team-sc-s-wrapper',
      	'orderby'         => 'post_date',
      	'order'           => 'DESC',
      	'include'         => '',
      	'exclude'         => '',
      	'meta_key'        => '',
      	'meta_value'      => '',
      	'post_parent'     => '',
      	'post_status'     => 'publish',
        'slides_per_view' => 5,
        'size'            => 'thumbnail',
        'url'             => '',
        'space_between'   => 15,
  	 ), $atts ) );
     $posts = get_posts(array(
       'post_type'       => $post_type,
       'numberposts'     => $numberposts,
       'offset'          => $offset,
       'category'        => $category,
       'orderby'         => $orderby,
       'order'           => $order,
       'include'         => $include,
       'exclude'         => $exclude,
       'meta_key'        => $meta_key,
       'meta_value'      => $meta_value,
       'post_parent'     => $post_parent,
       'post_status'     => $post_status,
     ));
     ob_start();
     ?>
      <div class="<?php echo $class_wrapper ?>">
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <?php foreach($posts as $post): setup_postdata($post); ?>
                <?php if($url): ?>
                  <a href="<?php echo get_the_permalink($post->ID); ?>">
                <?php endif; ?>
                  <div class="swiper-slide">
                    <div class="post-swiper-thumbnail">
                      <?php echo get_the_post_thumbnail( $post->ID, 'team-thumb' ); ?>
                    </div>
                    <div class="post-swiper-text">
                      <div class="post-swiper-title">
                        <strong><?php echo $post->post_title; ?></strong>
                      </div>
                      <div class="post-swiper-content">
                        <span><?php echo $post->post_content; ?></span>
                      </div>

                    </div>
                  </div>
                <?php if($url): ?>
                  </a>
                <?php endif; ?>

              <?php endforeach; wp_reset_postdata(); ?>

            </div>
            <!-- Add Arrows -->
             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>
        </div>

        <!-- Initialize Swiper -->
        <script>
          jQuery(document).ready(function($) {
            var swiper = new Swiper('.<?php echo $class_wrapper ?> .swiper-container', {
                nextButton: '.<?php echo $class_wrapper ?> .swiper-button-next',
                prevButton: '.<?php echo $class_wrapper ?> .swiper-button-prev',
                slidesPerView: 3,
                spaceBetween:  0,
                centeredSlides: true,
                //autoplay: 2500,
                autoplayDisableOnInteraction: false,
                loop: true,
                grabCursor: true
            });
          });
        </script>
      </div>
     <?php
    $html = ob_get_contents();
    ob_get_clean();
    return $html;
  }

  function wp_enqueue_scripts_cb(){
    wp_register_style( 'swiper', plugin_dir_url(__FILE__).'swiper/dist/css/swiper.min.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_script( 'swiper', plugin_dir_url(__FILE__).'swiper/dist/js/swiper.jquery.min.js', array('jquery'), $ver = '3.1.0' );
    wp_enqueue_style( 'swiper' );
    wp_enqueue_script( 'swiper' );
  }


  function hook_css(){

      $post = get_post();

      ?>
        <style>
          .team-sc-s-wrapper {
              width: 870px;
              margin: auto;
          }

          .team-sc-s-wrapper .swiper-slide {
            visibility: hidden;

          }

          .team-sc-s-wrapper .post-swiper-text {
            visibility: hidden;
          }

          .team-sc-s-wrapper .swiper-slide-active {
              !transform: scale(1.3);
              z-index: 1;
              transition-duration: 0.5s;
              visibility: visible;


          }

          .team-sc-s-wrapper .swiper-slide-active .post-swiper-text {
            !display: block;
            visibility: visible;

          }

          .team-sc-s-wrapper .swiper-slide-next,
          .team-sc-s-wrapper .swiper-slide-prev {
            !transition-duration: 1s;
                opacity: 0.5;
                transform: scale(0.8);
                visibility: visible;


          }

          .team-sc-s-wrapper .swiper-container {
              !width: 100%;
              !height: 100%;
          }

          .team-sc-s-wrapper .swiper-slide {
              min-height: 500px;
          }
        </style>
      <?php
    }
} $TheSliderDocsShortcodeS = new SliderDocsShortcodeS;
