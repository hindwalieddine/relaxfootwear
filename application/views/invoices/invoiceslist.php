<?php $total = 0 ?>

<div class="invoice-Listing">
    <div id="toolbox">   
        <?php echo form_open('/invoices', array('method' => 'get')) ?>
    </div>

    <table cellspacing="0" width="100%">
        <tr>
            <td>
                <label>From Date:</label>
                <?php echo form_input('from', set_value('from', !empty($from) ? $from : date('Y-m-d')), 'class="date"') ?>
            </td>
            <td><label>To Date:</label>
                <?php echo form_input('to', set_value('to', !empty($to) ? $to : date('Y-m-d')), 'class="date"') ?>
                <input type="submit" value="Search" />
            </td>
        </tr>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Date</th>
            <th>Details</th>
        </tr>

        <?php $r = 0 ?>
        <?php foreach ($result as $row) : $total += $row->Total ?>
            <tr class="row<?php echo $r ?>">
                <td><?php echo $row->FactID ?></td>
                <td><?php echo $row->Customer ?></td>
                <td><?php echo number_format($row->Total) ?></td>
                <td><?php echo $row->CreatingDate ?></td>
                <td><?php echo anchor('/invoices/invoice/' . $row->FactID, 'View Invoice Details') ?></td>	
            </tr>
            <?php
            $r = 1 - $r;
        endforeach
        ?>

        <tr>
            <th align="left"> </th>
            <th></th>
            <th align="left"><?php echo number_format($total) ?></th>
            <th><?php //echo number_format(
            //$totalSerie0 +
            //$totalSerie1 +
            //$totalSerie2 +
            //$totalSerie3 +
            //$totalSerie4 +
            //$totalSerie5 +
            //$totalSerie6 +
            // $totalSerie7 +
            //$totalSerie8 +
           // $totalSerie9 )
            ?></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

    </table>
    
    <table>
       
        <tr>
            <th>Shoes</th>
            <td><?php  echo number_format(
            $countSerie1 +
            $countSerie2 +
            $countSerie3 +
            $countSerie4 +
            $countSerie5 +
            $countSerie7        )  ?></td>
            <td><?php echo number_format(
            $totalSerie1 +
            $totalSerie2 +
            $totalSerie3 +
            $totalSerie4 +
            $totalSerie5 +
            $totalSerie7        ) ?></td>
            <td></td>
            <th>Accessories</th>
            <td><?php echo number_format($countSerie6) ?></td>
            <td><?php echo number_format($totalSerie6) ?></td>
            <td></td>
            <th>Bags</th>
            <td><?php echo number_format($countSerie8) ?></td>
            <td><?php echo number_format($totalSerie8) ?></td>
            <td></td>
            <th>Bas</th>
            <td><?php echo number_format($countSerie9) ?></td>
            <td><?php echo number_format($totalSerie9) ?></td>
            <td></td>
            <th>Clothes</th>
            <td><?php echo number_format($countSerie0) ?></td>
            <td><?php echo number_format($totalSerie0) ?></td>
        </tr>
        </table>
    <?php echo form_close() ?>

</div>