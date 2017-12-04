<h1>Edit the Supplier </h1>
<div id="diverror">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open('/suppliers/edit/' .$supplier->id) ?>

    <label>Name</label>
    <?php echo form_input('name', set_value('name', $supplier->name)) ?>
    
 
    <label>Phone</label>
    <?php echo form_input('phone', set_value('phone', $supplier->phone)) ?>
        
    <label>Mobile</label>
    <?php echo form_input('mobile', set_value('mobile', $supplier->mobile)) ?>
    
    <label>Adress</label>
    <?php echo form_input('adress', set_value('adress', $supplier->adress)) ?>
    
    
<br/>
	<input type="submit" value="Update Supplier" />
<?php echo form_close() ?>