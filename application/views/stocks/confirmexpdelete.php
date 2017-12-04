<?php echo form_fieldset('Delete Article From Stock') ?>
<div id="diverror">
<?php echo validation_errors() ?>
</div>
    <?php echo form_open('stocks/deleteexp/' . $stock->id) ?>

        <p>Are you sure to delete this article</p>
        
        <?php echo form_hidden('id' , $stock->id) ?>
        <?php echo anchor('reports/expedierarticlesbydate/', 'Cancel') ?>
        <?php echo form_submit('Delete' ,'Delete'); 	?>
        
    
    <?php echo form_close() ?>
<?php echo form_fieldset_close() ?>
