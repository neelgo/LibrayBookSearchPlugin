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
?>

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
    <select id="publisher" name="publisher" class="form-control">
	<?php $publishers = get_terms( 'publisher', array(
    'hide_empty' => false,
) );  
 
 foreach($publishers as $publisher){
  echo  '<option value="'.$publisher->term_id.'">'.$publisher->name.'</option>';
  
  } 
  ?>
    </select>
  </div>
        </div>
        <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6">
           <label class="col-md-4 control-label" for="rating">Rating</label>
  <div class="col-md-4">
    <select id="rating" name="rating" class="form-control">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
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
<div id="output"></div> 