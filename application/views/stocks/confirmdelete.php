<?php echo form_fieldset('Delete The Stock Article') ?>
<div id="diverror">
<?php echo validation_errors() ?>
</div>
    <?php echo form_open('stocks/delete/' . $supplier->id) ?>

        <p>Are you sure to delete this article from stock</p>
        
        <?php echo form_hidden('id' , $supplier->id) ?>
        <?php echo anchor('stocks/view/' . $supplier->id, 'Cancel') ?>
        <?php echo form_submit('Delete' ,'Delete'); 	?>
        
    
    <?php echo form_close() ?>
<?php echo form_fieldset_close() ?>
