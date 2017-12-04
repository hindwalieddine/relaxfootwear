<?php echo form_fieldset('Delete Article') ?>
<div id="diverror">
<?php echo validation_errors() ?>
</div>
    <?php echo form_open('articles/delete/' . $article->id) ?>

        <p>Are you sure to delete this article</p>
        
        <?php echo form_hidden('id' , $article->id) ?>
        <?php echo anchor('articles/view/' . $article->id, 'Cancel') ?>
        <?php echo form_submit('Delete' ,'Delete'); 	?>
        
    
    <?php echo form_close() ?>
<?php echo form_fieldset_close() ?>
