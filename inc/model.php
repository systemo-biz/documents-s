<?php
/*
Create slider docs model
*/

class SliderDocS {

  function __construct() {
      add_action('init', array($this, 'register_post_type'));
  }

  function register_post_type(){
      $labels = array(
        'name'=>'Слайдер документов',
        'singular_name'=>'Слайд документа',
        'add_new'=>'Добавить',
        'add_new_item'=>'Добавить',
        'edit_item'=>'Редактировать',
        'new_item'=>'Новый',
        'view_item'=>'Просмотр',
        'search_items'=>'Поиск',
        'not_found'=>'Не найден',
        'parent_item_colon'=>''
      );

     $supports = array(
      'editor',
      'title',
      'revisions',
      'thumbnail',
     );

    register_post_type('docs-s', array(
        'supports'      =>  $supports,
        'label'         =>  $labels['singular_name'],
        'labels'        =>  $labels,
        'public'        =>  true,
        'menu_icon'     => 'dashicons-media-document',
    	  'rewrite'       => array(
          'slug'          => 'docs',
          'with_front'    => false,
          'pages'         => true,
          'feeds'         => false,
        ),
        'has_archive'  => true,
        'query_var'    =>true,
    ));
  }

} $TheSliderDocS = new SliderDocS;

add_image_size( 'swiper-thumb', 333, 333, true );
