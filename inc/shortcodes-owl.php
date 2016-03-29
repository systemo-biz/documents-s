<?php


class SliderDocsShortcodeSowl {

  function __construct() {
    add_shortcode('owl-docs-s', array($this, 'shortcode_callback_owl'));
    add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_cb'));
    add_action('wp_head', array($this, 'hook_css_owl'));
  }


  function shortcode_callback_owl($atts){

    extract( shortcode_atts( array(
        'post_type'       => 'docs-s',
        'numberposts'     => 7,
      	'offset'          => 0,
      	'class_wrapper'   => 'docs-wrapper',
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
      <?php foreach($posts as $post): setup_postdata($post);
  			$thumb_id = get_post_thumbnail_id($post);
			$thumb_url = wp_get_attachment_image_url( $thumb_id, 'full' ); ?>
          <a href="<?php echo $thumb_url; ?>" title="<?php echo $post->post_title; ?>">
            <?php echo get_the_post_thumbnail( $post->ID, 'team-thumb' ); ?>
            <strong><?php echo $post->post_title; ?></strong>
          </a>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
    <!-- Initialize-->
    <script>
    	jQuery('.<?php echo $class_wrapper ?>').owlCarousel({ loop:true, navText : ["4", "5"], margin:10, responsive:{ 0:{ items:1, nav:false}, 600:{ items:3, nav:false }, 1000:{ items:5, nav:true } } });
    	 jQuery(document).ready(function() {
			 jQuery('.<?php echo $class_wrapper ?>').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				}
			});
		});
    </script>
     <?php
    $html = ob_get_contents();
    ob_get_clean();
    return $html;
  }

  function wp_enqueue_scripts_cb(){
    wp_register_style( 'magnific', plugin_dir_url(__FILE__).'magnific/magnific-popup.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_script( 'magnific', plugin_dir_url(__FILE__).'magnific/main.js', array('jquery'), $ver = '3.1.0' );
    wp_enqueue_style( 'magnific' );
    wp_enqueue_script( 'magnific' );
    wp_register_style( 'owlcarousel', plugin_dir_url(__FILE__).'owlcarousel/assets/owl.carousel.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_script( 'owlcarousel', plugin_dir_url(__FILE__).'owlcarousel/owl.carousel.min.js', array('jquery'), $ver = '3.1.0' );
    wp_enqueue_style( 'owlcarousel' );
    wp_enqueue_script( 'owlcarousel' );
  }


  function hook_css_owl(){

      $post = get_post();

      ?>
        <style>
        	div.owl-controls > div.owl-nav > div.owl-prev {
			    font-family: 'ETmodules';
			    speak: none;
			    font-weight: normal;
			    font-variant: normal;
			    text-transform: none;
			    line-height: 1;
			    -webkit-font-smoothing: antialiased;
	      		font-size: 80px;
		       	display: block;
			    position: absolute;
			    left: -5%;
			}
			div.owl-controls > div.owl-nav > div.owl-next {
			    font-family: 'ETmodules';
			    speak: none;
			    font-weight: normal;
			    font-variant: normal;
			    text-transform: none;
			    line-height: 1;
			    -webkit-font-smoothing: antialiased;
		        font-size: 80px;
		        display: block;
			    position: absolute;
			    right: -5%;
			}
			div.owl-controls {
			    position: absolute;
			    top: 30%;
			    width: 100%;
			}
        </style>
      <?php
    }
} $TheSliderDocsShortcodeSowl = new SliderDocsShortcodeSowl;