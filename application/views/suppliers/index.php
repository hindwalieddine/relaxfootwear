<div class="suppliers-listing">
    <div id="toolbox" class="noprint">
    <?php echo anchor('/suppliers/create', 'Create Supplier') ?>
       
    </div>
    <table cellspacing="0" width="100%">
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Mobile </th>
            <th>Adress </th>
            <th></th>
            <th></th>
        </tr>
        <?php $r = 0 ?>
        <?php foreach ($suppliers as $supplier) : ?>
        <tr class="row<?php echo $r ?>">
            <td><?php echo $supplier->id ?></td>
            <td><a href="<?php echo config_item('base_url')?>suppliers/view/<?php echo $supplier->id ?>"><?php echo $supplier->name ?></a></td>
 
            <td><?php echo $supplier->phone ?></td>
            <td><?php echo $supplier->mobile ?></td>
            <td><?php echo $supplier->adress ?></td>
            <td><?php echo anchor('/suppliers/edit/'.$supplier->id, 'Edit') ?>
            <td><?php echo anchor('/suppliers/delete/'.$supplier->id, 'Delete') ?>
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
    
</div>