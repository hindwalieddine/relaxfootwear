<h1 id="title">Create New Supplier </h1>
<div id="diverror">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open('/suppliers/create/') ?>
    <label>Name</label>
    <?php echo form_input('name', set_value('name')) ?>
    
 
    <label>Phone</label>
    <?php echo form_input('phone', set_value('phone')) ?>
        
    <label>Mobile</label>
    <?php echo form_input('mobile', set_value('mobile')) ?>
    
    <label>Adress</label>
    <?php echo form_input('adress', set_value('adress')) ?>
    
    
<br/>
	<input type="submit" value="Insert Supplier" />
<?php echo form_close() ?>