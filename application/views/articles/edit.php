<h1>Edit the article </h1><br>
<div id="diverror">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open('/articles/edit/' .$article->id) ?>

    <label>code </label>
    <?php echo form_input('code', set_value('code', $article->code)) ?>
   
 
    <label>Purchase Price</label>
    <?php echo form_input('purchase_price', set_value('purchase_price', $article->purchase_price)) ?>
        
    <label>Sale Price</label>
    <?php echo form_input('sale_price', set_value('sale_price', $article->sale_price)) ?>
    
    <label>Discount Price</label>
    <?php echo form_input('discount_price', set_value('discount_price', $article->discount_price)) ?>
    
    <label>In Discount </label>
    <?php echo form_input('in_discount', set_value('in_discount', $article->in_discount)) ?>
        
    <label>Image</label>
    <img src=" <?php echo base_url().'images/'. $article->code .'.jpg';?>" width="150" height="100" alt=""/>
    	<div id="upload">
		<?php
	        echo form_open_multipart('upload/do_upload'); ?>

		<?php

                $data = array(
                'name'        => 'userfile',
                             );
                echo form_upload($data);
		echo form_submit('submit', 'upload image');
                echo form_close();
		?>
     	</div>
    
    <label>Description</label>
    <?php echo form_input('description', set_value('description', $article->description)) ?>
    
    <label>Supplier name</label>

    <select name = "supp_id" id = "supp_id" >
<?php foreach($result as $row){?>
<option <?php echo $article->supp_id == $row->id?'selected=selected':'' ?> value = "<?php echo $row->id?>"><?php echo $row->name;?></option>
<?php } ?>
    </select>
<br/>
    <label>title </label>
    <?php echo form_input('title', set_value('title', $article->title)) ?>
	<input type="submit" value="Update Article" />
<?php echo form_close() ?>