<?php

if ($_POST['action'] != 'AjaxFunction')
    return;


//sanitize_text_field
global $wpdb, $wp_query;
//use extract later for vars 
$bookname = sanitize_text_field($_POST['formdata']['bookname']);
$author = sanitize_text_field($_POST['formdata']['author']);
$publisher = $_POST['formdata']['publisher'];
$rating = $_POST['formdata']['rating'];
$minPrice = $_POST['formdata']['minPrice'];
$maxPrice = $_POST['formdata']['maxPrice'];
$paged = $_POST['formdata']['paged'] ? $_POST['formdata']['paged'] : 1;
$postPerPage = 2;
//$paged = sanitize_text_field($_POST['page']);
//$wp_query->set_query_var('islbsajax','yes');
//set_query_var('islbsajaxtype','ajax');
//print_r($_POST);
//die;
/* * ************************************
  NOTE : we are having case similar to
  https://core.trac.wordpress.org/ticket/42746
  this is not issue this is Changed behaviour of esc_sql() in WordPress 4.8.3
  So we have dropped the idea of using  wp_query here
  $wpdb->get_results etc are also under wordpress given api so we can use it.
  finally found a solution to hook late solved this

  $argsx = array(
  'post_type'  => 'book', // will dynamically get this incase we extend this to seach any post_type

  's' => $bookname,

  'posts_per_page' =>  2,  // just 2 beacase I dont want to do much data entry to reflect paginations
  'paged' => $paged,	'order' => 'DESC',
  'tax_query' => array(
  'relation' => 'AND',// for more number of results set OR otherwise set AND for exact match
  array(
  'taxonomy' => 'publisher',
  'field' => 'term_id',
  'terms' => $publisher
  ),
  array(
  'taxonomy' => 'author',
  'field' => 'slug',
  'terms' => $author
  )
  ),
  'meta_query' => array(
  'relation' => 'AND',  // for more number of results set OR otherwise set AND for exact match

  array(
  'key'     => 'rating',
  'value'   => $rating,
  'compare' => '='
  ),

  array(
  'key'     => 'price',
  'value'   => array( $minPrice, $maxPrice ),
  'type'    => 'numeric',
  'compare' => 'BETWEEN'
  )

  ),
  );
 */
$args = array(
    'post_type' => 'book', // will dynamically get this incase we extend this to seach any post_type  
    'posts_per_page' => $postPerPage, // just 1-2 beacase I dont want to do much data entry to reflect paginations
    'paged' => $paged,
    'order' => 'DESC');

if ($bookname !== '') {
    $args['s'] = $bookname;
}
if ($publisher !== '') {
    $args['tax_query'][] = [
        'taxonomy' => 'publisher',
        'field' => 'term_id',
        'terms' => $publisher];
}
if ($author !== '') {
    /* if(count($args['tax_query'])==0){				
      $args['tax_query'] =  [
      'taxonomy' => 'author',
      'field' => 'slug',
      'terms' =>$author ];
      }else{ */
    $args['tax_query'][] = [
        'taxonomy' => 'author',
        'field' => 'slug',
        'terms' => $author];
    //}
}
if ($rating !== '') {
    $args['meta_query'][] = [
        'key' => 'rating',
        'value' => $rating,
        'compare' => '='];
}
//if($publisher !== ''){					
$args['meta_query'][] = [
    'key' => 'price',
    'value' => array($minPrice, $maxPrice),
    'type' => 'numeric',
    'compare' => 'BETWEEN'];
//}
//echo "<pre>"; print_r($args) ; print_r($argsx) ; exit;
$query = new WP_Query($args);
//echo $wpdb->remove_placeholder_escape( $query->request );
// echo"<pre>";	 print_r($query);	echo"</pre>";  	die; 
$total_count_or_row = $query->found_posts;
/* */

if ($total_count_or_row > 0) {
    $pagerCount = ceil($total_count_or_row / $postPerPage);
}
if ($query->have_posts()) {
    echo '<div class="rowGroup">';
    $sr = 1;
    while ($query->have_posts()) {
        $query->the_post();

        include 'comman-row-loop.php';
        // echo get_template_part('commanli','loop');   this functin is meant for thems so removed here
        $sr++;
    }
    echo '</div>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    echo '<div class="rowGroup"><div class="row">No posts found.</div></div>';
}


echo '<div id="pager">
 <ul class="pagination">';
for ($count = 1; $count <= $pagerCount;) {
    echo '<li><a href="#">' . $count . '</a></li>';
    $count++;
}

echo '</ul></div>';




