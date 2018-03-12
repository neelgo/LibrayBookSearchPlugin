<?php
/**
 * Custom Post Type book
 *
 * Used to help create custom post types for Wordpress.
 * @link http://github.com/jjgrainger/wp-custom-post-type-class/
 *
 * @author  Neelesh Gothania <mr.neelesh.gothania@gmail.com>
 * @version 0.2
 */ 
 
 	
		
// create a book custom post type
$books = new CPT('book');

// create a author taxonomy
$books->register_taxonomy('author');
// create a publisher taxonomy
$books->register_taxonomy('publisher');


// define the columns to appear on the admin edit screen
$books->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'author' => __('Author'),
    'publisher' => __('Publisher'),
    'price' => __('Price'),
    'rating' => __('Rating'),
    'date' => __('Date')
));


// populate the price column
$books->populate_column('price', function($column, $post) {
   echo $price = get_post_meta( $post->ID, 'price', true );
   // echo "£" . get_field('price'); // ACF get_field() function

}); 


// populate the ratings column
$books->populate_column('rating', function($column, $post) {
	echo 	$rating = get_post_meta( $post->ID, 'rating', true ); 
  //  echo get_field('rating') . '/5'; // ACF get_field() function

});


// make rating and price columns sortable
$books->sortable(array(
    'price' => array('price', true),
    'rating' => array('rating', true)
));


// use "pages" icon for post type
$books->menu_icon("dashicons-book-alt");
	