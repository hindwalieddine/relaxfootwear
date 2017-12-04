<script id="invoiceRowTemplate" type="text/x-ahmad">
 <tr class="invoice-row">
          <td><?php echo form_input('article_id[]', '','data-url="/relax/ajax/articles"') ?></td>
          <td><?php echo form_input('quantity[]', '', 'class=number') ?></td>
          <td><?php echo form_dropdown('size[]', array(), '') ?></td>
          <td><?php echo form_input('sale_price[]', '', 'disabled="disabled"') ?></td>
          <td><?php echo form_input('discount_price[]', '', 'disabled="disabled"') ?></td>
          <td><?php echo form_input('cash[]', '') ?>  </td>
          <td><?php echo form_input('comment[]', '') ?>  </td>
          <td><?php echo form_dropdown('stock[]', array(1 => 'Relax',2 => 'Solderie')) ?>  </td>
          <td><span></span></td>
        <td><a class="delete" href="#" onclick="deleteRow(this)">Delete Row</a></td>
    </tr>
</script>

<div class="invoices-listing">
    <?php echo form_open('/invoices/create', 'id="createInvoice"') ?>
    <div id="toolbox" class="noprint">
        <a href="#" class="submit">Save Invoice</a>
    </div>
    <h1>Invoice #: <?php echo $invoiceId ?></h1>
    <table id="createInvoiceTable" cellspacing="0" cellspacing="0">

        <tr>
            <th>Article</th>
            <th>Quantity</th>
            <th>Size</th>
            <th>Origine Price</th>
            <th>Discounted Price</th>
            <th>Cash</th>
            <th>Comment</th>
            <th></th>
            <th></th>
        </tr>
        <tr class="invoice-row">
            <td><?php echo form_input('article_id[]', set_value('article_id[]'),'data-url="/relax/ajax/articles"') ?></td>
            <td><?php echo form_input('quantity[]', set_value('quantity[]'), 'class=number') ?></td>
            <td><?php echo form_dropdown('size[]', array(), set_value('size[]')) ?></td>
            <td><?php echo form_input('sale_price[]', set_value('sale_price[]'), 'disabled="disabled"') ?></td>
            <td><?php echo form_input('discount_price[]', set_value('discount_price[]'), 'disabled="disabled"') ?></td>
            <td><?php echo form_input('cash[]', set_value('cash[]')) ?>  </td>
            <td><?php echo form_input('comment[]', set_value('comment[]')) ?>  </td>
            <td  class="noprint"><?php echo form_dropdown('stock[]', array(1 => 'Relax',2 => 'Solderie')) ?>  </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                Total : <span id="invoice-total"></span> <br/>
                Discount : <span id="discount-value"></span> <br/>
            </th>
            <th></th>
        </tr>


    </table>
    <?php echo form_close() ?>
</div>

<script>
    setInterval("calculateTotal()", 100);
</script>
