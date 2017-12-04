<div class="articles-listing">
    <div id="toolbox" class="noprint">
    <?php echo anchor('/articles/create', 'Create Article') ?><br>
    </div>
    <table cellspacing="0" width="100%">
        
        <tr>
            <th>Code</th>
            <th>Title</th>
            <th>Purchase Price </th>
            <th>Sale Price </th>
            <th>Discount Price </th>
            <th>In Discount</th>
            <th>Supplier</th>
            <th></th>
            <th></th>
        </tr>
        <?php $r = 0 ?>
        <?php foreach ($articles as $article) : ?>
        <tr class="row<?php echo $r ?>">
            <td><a href="<?php echo config_item('base_url')?>articles/view/<?php echo $article->id ?>"><?php echo $article->code ?></a></td>
            <td><?php echo $article->title ?></td>
            <td><?php echo $article->purchase_price ?></td>
            <td><?php echo $article->sale_price ?></td>
            <td><?php echo $article->discount_price ?></td>
            <td><?php echo $article->in_discount?'true' :'false' ?></td>
            <td><?php echo $article->supp_id ?></td>
            <td><?php echo anchor('/articles/edit/'.$article->id, 'Edit') ?>
            <td><?php echo anchor('/articles/delete/'.$article->id, 'Delete') ?>
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
    
</div>