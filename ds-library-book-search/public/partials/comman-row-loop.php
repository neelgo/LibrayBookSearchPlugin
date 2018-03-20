<?php

echo '<div class="row" >
		<div class="name cell">
		' . $sr . '
		</div>
		<div class="name cell  col-sm-2">
		<a href="' . get_the_permalink() . '">
		' . get_the_title() . ' </a>
		</div>
		<div class="price cell  col-sm-1"> $' . get_post_meta(get_the_ID(), 'price', true) . '
		</div>
		<div class="author cell col-sm-3">' . get_the_term_list(get_the_ID(), 'author', '', ', ') . '</div>
		<div class="publisher cell col-sm-3"> ' . get_the_term_list(get_the_ID(), 'publisher', '', ', ') . ' 
		</div>
		<div class="rating cell  col-sm-2 " >' . Ds_library_book_search_Public::Ds_library_book_search_rating(get_post_meta(get_the_ID(), 'rating', true)) . '
		  </div>
		</div>';

