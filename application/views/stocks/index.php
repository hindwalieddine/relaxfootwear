<?php  $stockes = array('1' => 'Relax', '2' => 'Solderie', '3' => 'Depot') ?>
<div class="articles-listing">
    <div id="toolbox" class="noprint">
    <?php echo anchor('/stocks/insert/1' , 'Insert to Relax stock') ?><br/>
    <?php echo anchor('/stocks/insert/2' , 'Insert to Solderie stock') ?><br/>
    <?php echo anchor('/stocks/insert/3' , 'Insert to Depot stock') ?>
    </div>
    <table cellspacing="0" width="100%">
        
        <tr>
            <th>Article</th>
            <th>qty1</th>
            <th>qty2</th>
            <th>qty3</th>
            <th>qty4</th>
            <th>qty5</th>
            <th>qty6</th>
            <th>qty7</th>
            <th>qty8</th>
            <th>qty9</th>
            <th>qty10</th>
            <th>qty11</th>
            <th>qty12</th>
            <th>qty13</th>
            <th>stock</th>
            <th></th>
        </tr>
        <?php $r = 0 ?>
        <?php foreach ($stocks as $stock) : ?>
        <tr class="row<?php echo $r ?> status-<?php echo $stock->action ?>">
            <td><a href="<?php echo config_item('base_url')?>stocks/view/<?php echo $stock->id ?>"><?php echo $stock->article_id ?></a></td>
            <td><?php echo $stock->qty1 ?></td>
            <td><?php echo $stock->qty2 ?></td>
            <td><?php echo $stock->qty3 ?></td>
            <td><?php echo $stock->qty4 ?></td>
            <td><?php echo $stock->qty5 ?></td>
            <td><?php echo $stock->qty6 ?></td>
            <td><?php echo $stock->qty7 ?></td>
            <td><?php echo $stock->qty8 ?></td>
            <td><?php echo $stock->qty9 ?></td>
            <td><?php echo $stock->qty10 ?></td>
            <td><?php echo $stock->qty11 ?></td>
            <td><?php echo $stock->qty12 ?></td>
            <td><?php echo $stock->qty13 ?></td>
            <td><?php echo $stockes[$stock->stock] ?></td>
            
            <td>
				<?php echo anchor('/stocks/delete/'.$stock->id, 'Delete') ?>
            </td>	
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
    
</div>