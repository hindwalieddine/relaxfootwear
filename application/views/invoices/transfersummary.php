<div class="invoice-summary">
    <div id="toolbox">   
    	<div class="filter">
        	Show the summary of 
        	<?php echo form_dropdown('invoice', 
		 array('-1'=>'All', '1' => 'Relax', '2' => 'Solderie', '3' => 'Depot'),$stockId,'id="invoiceFilter"') ?>
        </div>
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
            
        </tr>
        
        <?php $r = 0 ?>
        <?php foreach ($result as $row) : ?>
        <tr class="row<?php echo $r ?>">
            <td><?php echo $row->article_id ?></td>
            <td><?php echo $row->qty1 ?></td>
            <td><?php echo $row->qty2 ?></td>
            <td><?php echo $row->qty3 ?></td>
            <td><?php echo $row->qty4 ?></td>
            <td><?php echo $row->qty5 ?></td>
            <td><?php echo $row->qty6 ?></td>
            <td><?php echo $row->qty7 ?></td>
            <td><?php echo $row->qty8 ?></td>
            <td><?php echo $row->qty9 ?></td>
            <td><?php echo $row->qty10 ?></td>
            <td><?php echo $row->qty11 ?></td>
            <td><?php echo $row->qty12 ?></td>
            <td><?php echo $row->qty13 ?></td>
            <td><?php echo $row->stock ?></td>
            	
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
    
</div>