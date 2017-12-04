<?php echo form_fieldset('Delete Supplier') ?>
<div id="diverror">
<?php echo validation_errors() ?>
</div>
    <?php echo form_open('suppliers/delete/' . $supplier->id) ?>

        <p>Are you sure to delete this supplier</p>
        
        <?php echo form_hidden('id' , $supplier->id) ?>
        <?php echo anchor('suppliers/view/' . $supplier->id, 'Cancel') ?>
        <?php echo form_submit('Delete' ,'Delete'); 	?>
        
    
    <?php echo form_close() ?>
<?php echo form_fieldset_close() ?>
