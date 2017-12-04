<h1 id="title">Create New Article </h1>
<div id="diverror">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open_multipart('/articles/create') ?>

    <label>Code</label>
    <?php echo form_input('code', set_value('code')) ?>

    <label>Supplier name</label>

    <select name = "supp_id" id = "supp_id" >
<?php foreach($result as $row){?>
<option value = "<?php echo $row->id?>"><?php echo $row->name;?></option>
<?php } ?>
    </select>


    <label>Purchase Price</label>
    <?php echo form_input('purchase_price', set_value('purchase_price')) ?>
        
    <label>Sale Price</label>
    <?php echo form_input('sale_price', set_value('sale_price')) ?>
    
    <label>Discount Price</label>
    <?php echo form_input('discount_price', set_value('discount_price')) ?>
    
    <label>In Discount</label>
    <?php echo form_input('in_discount', set_value('in_discount')) ?>
    
    <label>Image</label>
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
    <?php echo form_textarea('description', set_value('description')) ?>

    <label>Title</label>
    <?php echo form_input('title' , set_value('title')) ?>

<br/>
	<input type="submit" value="Insert Article" />
<?php echo form_close() ?>

