<div class="article-view view">
    <div id="toolbox" class="noprint">
        <?php echo anchor('/articles/edit/' . $article->id , 'Edit Article') ?>
        <?php echo anchor('/articles/delete/' . $article->id , 'Delete Article') ?>
    </div>
    <h1 class="article-title"><?php echo $article->title ?></h1>
     <table><tr><td>
    <table>
       <tr> <th>Code </th><td><?php echo $article->code ?></td>
        </tr>
        <tr>
            <th>Title </th><td><?php echo $article->title ?></td>
        </tr>
        <tr>
            <th>Purchase Price </th><td><?php echo $article->purchase_price ?></td>
        </tr>
        <tr>
            <th>Sale Price </th><td><?php echo $article->sale_price ?></td>
        </tr>
        <tr>
            <th>Discount Price </th><td><?php echo $article->discount_price ?></td>
        </tr>
        <tr>
            <th>In Discount </th><td><?php echo $article->in_discount ?></td>
        </tr>
        <tr>
            <th>Description </th><td><?php echo $article->description ?></td>
        </tr>
    </table>
    </td>
    <td><img width="250" src="<?php echo config_item('base_url') ?>/images/<?php echo $article->code?>.jpg" alt="" title="" /></td></tr></table>
    
</div>