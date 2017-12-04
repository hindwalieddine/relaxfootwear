function formatNum(num) {
    var p = num.toFixed(2).split(".");
    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
}

function calculateTotal() {
    var total = 0, discount = 0;
    $('#createInvoiceTable tr').each(function() {
        var qty = Number($.trim($(this).find('[name="quantity[]"]').val()));
        var sale = Number($.trim($(this).find('[name="sale_price[]"]').val()));
        var cash = Number($.trim($(this).find('[name="cash[]"]').val()));
        total += cash;
        discount += ((sale * qty) - cash);
    });

    $('#invoice-total').text(formatNum(total));
    $('#discount-value').text(formatNum(discount));
}

function range(min, max) {
    var res = [];
    for (i = min; i < max + 1; i++) {
        res.push(i);
    }
    return res;
}

var sizes = function()
{
    this.data =
            {
                1: range(16, 28), //Kids
                2: range(27, 39), //Kids
                3: range(35, 42), //Women
                4: range(35, 42), //Women
                5: range(35, 42), //Women
                6: ['Accessoires'], // Accessoires
                7: ['39', '40', '41', '41.5', '42', '42.5', '43', '43.5', '44', '45', '46', '47', '48'], //Men
                8: ['Bag'], // Bags
                9: ['BB', '0', '2', '4', '6', '8', '10', '10.5', '11', '12'] //Bas
            }

    this.getSizes = function(articleId) {
        return this.data[(articleId + '').split('')[0]];
    }
}



function deleteRow(el) {
    var $row = $(el).closest('tr.invoice-row');
    if (confirm('Are you sure you want to delete this row  ? ')) {
        $row.remove();
    }
}

$(function() {


    // Date Picker
    $('input[type=text].date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('body').on('focus', 'input[data-url]', function() {

        if ($(this).data('data-url')) {
            return false;
        }
        $(this).data('data-url', true);

        var $this = $(this);
        $this.autocomplete(
                {
                    source: $this.attr('data-url'),
                    minLength: 1,
                    select: function(event, ui) {
                        //console.log(ui.item.label);
                        $this.val(ui.item.label);
                        return false;
                    },
                    focus: function(event, ui) {
                        $this.val(ui.item.label);
                        return false;
                    }
                }
        );
    })


    // Filter the stock
    $('[name=stock]').change(function(i) {
        var value = $(this).val();
        if (value == -1) {
            window.location.href = base + 'stocks/summary/';
        } else {
            window.location.href = base + 'stocks/summary/' + value;

        }
    })

    // Filter the action
    $('[name=action]').change(function(i) {
        var value = $(this).val();
        if (value == 1) {
            window.location.href = base + 'reports/insertedarticlesbydate/1';
        }
        if (value == 2) {
            window.location.href = base + 'reports/insertedarticlesbydate/2';
        }
        if (value == 3) {
            window.location.href = base + 'reports/insertedarticlesbydate/4';
        } else {

        }
    })


    $('#createInvoice').on('blur', '[name="article_id[]"]', function() {

        var self = $(this),
                $tr = self.closest('tr'),
                $qty = $tr.find('[name="quantity[]"]'),
                value = self.val(),
                qty = $.trim($qty.val()),
                currentPrice,
                total;

        $.get(base + 'ajax/articlebycode/' + value, function(r) {
            $tr.find('[name="sale_price[]"]').val(r.sale_price);
            $tr.find('[name="discount_price[]"]').val(r.discount_price);

            if (r.in_discount == 1)
            {
                currentPrice = r.discount_price;
            }
            else
            {
                currentPrice = r.sale_price;
            }
            $tr.data('currentPrice', currentPrice);

            // Set the sizes
            var articleSizes = (new sizes).getSizes(value);

            $tr.find('select[name="size[]"]').empty()
            $.each(articleSizes, function(i, e) {
                $tr.find('select[name="size[]"]').append('<option value="' + (i + 1) + '">' + e + '</option>')
            })

            if (isNaN(parseInt(qty))) {
                qty = 1
            } else {
                qty = parseInt(qty);
            }

            $qty.val(qty);
            $tr.find('[name="cash[]"]').val(currentPrice * qty )
        })

    })

    $('#createInvoice').on('keyup', '[name="article_id[]"]', function(e) {

        if (!(e.which in  {
            7: '',
            16: ''
        })) {
            if ($(this).val().length == 7) {

                $(this).parent().next().find('input[type=text]').focus();
            }
            else if ($(this).val().length > 7) {

                $(this).val($(this).val().substr(0, 7))
            }
        }
    })

    $('#createInvoice').on('change', '[name="quantity[]"]', function() {

        var self = $(this),
                $tr = self.closest('tr'),
                currentPrice = Number($tr.data('currentPrice')),
                value = self.val();

        value = value.replace(/[^\d-]/g, '');
        self.val(value);


        $cash = $tr.find('[name="cash[]"]');
        $cash.val(value * currentPrice)

    })

    $('#createInvoice').on('blur', '[name="comment[]"]', function() {
        var self = $(this),
                $tr = self.closest('tr'),
                $tmpl = $($('#invoiceRowTemplate').html());

        if ($tr.find('[name="article_id[]"]').val() != '' && $tr.index() == (self.closest('table').find('tr').length - 2)) {
            $tr.after($tmpl);
            $tmpl.find('[name="article_id[]"]').focus();

        }
    });



    $('#createInvoice .submit').click(function(e) {
        e.preventDefault();
        var toremove = $('.invoice-row')
                .filter(function() {
            return $(this).find('[name="article_id[]"]').val().length === 0;
        }).remove();

        var success = true;

        $('[name="cash[]"]').each(function() {
            var val = Number($.trim($(this).val()));
            if ((val < 1000) && (val > -1000)) {
                success = false;
            }
        });

        if (!success) {
            e.preventDefault();
            alert('Minimum price is 1000');
            return false;
        }

        // success
        $('#createInvoice')[0].submit();

    });



})