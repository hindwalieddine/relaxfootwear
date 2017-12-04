<?php $this->load->model('invoices_model'); ?>
<div class="invoice">

    <div id="toolbox">   
    	Invoice number: <?php echo $id ?><br/>
        <?php if(!empty($result) && !empty($result[0]) && !empty($result[0]->customer) ): ?>
        Customer Name : <?php echo $result[0]->customer ?><br/>        
        <?php endif ?>
        <input type="button" class="noprint" value="Print This Invoice" onclick="window.print();return false;" />
        <p class="noprint" style="float: right"><?php echo anchor('/invoices/create', 'New Invoice') ?></p>
    </div>
    <table cellspacing="0" width="90%">
        
        <tr>
            <th>Article</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Origine Price</th>
            <th>Sale Price</th>
            <th>Total Price</th>
            <th class="noprint">Comment</th>
            <th class="noprint"></th>
            
        </tr>
        
        <?php $total = 0; $r = 0 ?>
        <?php foreach ($result as $row) :
            $total += $row->quantity * $row->sale_price;
            ?>
        <tr class="row<?php echo $r ?>">
            <td><?php echo $row->article_id ?></td>
            <td><?php echo $this->invoices_model->get_the_size(Array('article'=>$row->article_id,'size'=>$row->size)) ?></td>
            <td><?php echo $row->quantity ?></td>
            <td><?php echo $row->orgprice ?></td>
            <td><?php echo number_format($row->sale_price) ?></td>
            <td>
              
            <?php echo number_format($row->quantity * $row->sale_price) ?> </td>
            <td class="noprint"><?php echo $row->comment ?></td>
            <td width="170" class="noprint"><?php echo anchor('/invoices/invoice/'. $row->order_id, 'View Invoice Details') ?></td>
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>

    <p style="font-size:14px;font-weight: bold;margin-top:10px;">

        Total : <?php echo number_format($total) ?>
    </p>

</div>

<script> $(function(){window.print()  }) </script>