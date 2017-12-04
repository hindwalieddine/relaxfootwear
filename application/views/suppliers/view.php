<div class="supplier-view view">

    <div id="toolbox">   
        <?php echo anchor('/suppliers/edit/' . $supplier->id , 'Edit Supplier') ?>
        <?php echo anchor('/suppliers/delete/' . $supplier->id , 'Delete Supplier') ?>
    </div>
    <h1 class="supplier-name"><?php echo $supplier->name ?></h1>
    <table><tr>
        <th>Name </th><td><?php echo $supplier->name ?></td>
        </tr>
        <tr>
            <th>Phone </th><td><?php echo $supplier->phone ?></td>
        </tr>
        <tr>
            <th>Mobile </th><td><?php echo $supplier->mobile ?></td>
        </tr>
        <tr>
            <th>Adress </th><td><?php echo $supplier->adress ?></td>
        </tr>
       
    </table>
</div>