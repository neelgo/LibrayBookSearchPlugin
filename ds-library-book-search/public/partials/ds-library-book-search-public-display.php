<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/public/partials
 */
//get min max price range
global $wpdb;
$query = "SELECT max(meta_value)as maxprice, min(meta_value)as minprice FROM " . $wpdb->prefix . "postmeta WHERE meta_key='price'";
$theminmax = $wpdb->get_row($query);
//print_r($theminmax);
?>
<script>
    jQuery(function ($) {
        $("#slider-range").slider({
            range: true,
            min: <?php echo $theminmax->minprice; ?>,
            max: <?php echo $theminmax->maxprice; ?>,
            values: [<?php echo $theminmax->minprice; ?>, <?php echo $theminmax->maxprice; ?>],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                $("#minPrice").val(ui.values[ 0 ]);
                $("#maxPrice").val(ui.values[ 1 ]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        $("#minPrice").val($("#slider-range").slider("values", 0));
        $("#maxPrice").val($("#slider-range").slider("values", 1));
    });
</script>
<div class="containerx">
    <div class="row">
        <form class="Ds_library_book_search" id="Ds_library_book_search" name="Ds_library_book_search" class="form-horizontal">  
            <fieldset>
                <legend >Book Search</legend>

                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                    <label class="col-md-4 control-label" for="bookname">Book Name</label>  
                    <div class="col-md-6">
                        <input id="bookname" name="bookname" type="text" placeholder="Book Name" class="form-control input-md">
                        <span class="help-block">Enter book name</span>  
                    </div>
                </div>
                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                    <label class="col-md-4 control-label" for="author">Author</label>  
                    <div class="col-md-6">
                        <input id="author" name="author" type="text" placeholder="Author" class="form-control input-md">
                        <span class="help-block">Enter author name</span>  
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                    <label class="col-md-4 control-label" for="publisher">Publisher</label>
                    <div class="col-md-6">
                        <select id="publisher" name="publisher" class="form-control"><option value="">--any--</option>
                            <?php
                            $publishers = get_terms('publisher', array(
                                'hide_empty' => false,
                                    ));

                            foreach ($publishers as $publisher) {
                                echo '<option value="' . $publisher->term_id . '">' . $publisher->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                    <label class="col-md-4 control-label" for="rating">Rating</label>
                    <div class="col-md-4">
                        <select id="rating" name="rating" class="form-control"><option value="">--any--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div> <div class="clearfix"></div> 
                <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
                    <label class="col-md-4 control-label" for="amount">Price(min-max)</label>
                    <div class="col-md-4">
                        <input type="text" id="amount" readonly style="border:0; color:#337ab7; font-weight:bold;" class="form-control">
                        <input type="hidden" id="minPrice" name="minPrice" />
                        <input type="hidden" id="maxPrice" name="maxPrice" />
                        <input type="hidden" id="paged" name="paged"  />
                        <div id="slider-range"></div>
                    </div>
                </div>   
                <div class="clearfix"></div>   
            </fieldset>
        </form>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
            <div class="center-me">
                <button id="dslbssearch" name="dslbssearch" class="btn btn-primary btn-center">Search</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <br /><br />
    </div>
</div> 
<div class="table ">
    <div class="header row">
        <div class="cell">#</div>
        <div class="cell  col-sm-2">Book Name</div>
        <div class="cell  col-sm-1">Price</div>
        <div class="cell  col-sm-3">Authors</div>
        <div class="cell  col-sm-3">Publishers</div>
        <div class="cell  col-sm-2">Rating</div>
    </div>

    <div id="output">
        <?php
        $postPerPage = 1;
        $sr = 1;
        //if(!isset($_POST['action']) && $_POST['action'] != 'AjaxFunction'){
        $argsx = array('post_type' => 'book', 'posts_per_page' => $postPerPage,
            'order' => 'ASC', 'orderby' => 'title');
        $query = new WP_Query($argsx);
        //echo $wpdb->remove_placeholder_escape( $query->request );
        // echo"<pre>";	 print_r($query);	echo"</pre>";  	die; 
        $total_count_or_row = $query->found_posts;
        /* */
        if ($total_count_or_row > 0) {
            $pagerCount = ceil($total_count_or_row / $postPerPage);
        }
        if ($query->have_posts()) {
            echo '<div class="rowGroup">';
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
        //}  
        ?>


    </div> 
    <div id="pager">
        <ul class="pagination">
            <?php
            if ($total_count_or_row > 0) {
                for ($count = 1; $count <= $pagerCount;) {
                    echo '<li><a href="#">' . $count . '</a></li>';
                    $count++;
                }
            }
            ?>
        </ul>
    </div>