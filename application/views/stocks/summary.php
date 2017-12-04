<?php $this->load->model('articles_model'); ?>
<?php
$stockname = 'All';
if ($stockId == 1) {
    $stockname = "Relax";
}
if ($stockId == 2) {
    $stockname = "Solderie";
}
if ($stockId == 3) {
    $stockname = "Depot";
}
$title = $stockname . ' Stock';
?>
<h1 id="title"><?php echo $title; ?></h1>
<div class="stock-summary">
    <div id="toolbox" class="noprint">

        <div class="filter">
            Show the summary of
            <?php echo form_dropdown('stock', array('-1' => 'All', '1' => 'Relax', '2' => 'Solderie', '3' => 'Depot'), $stockId, 'id="stockFilter"')
            ?>
        </div>
        <div class="noprint">
            <?php echo form_open('/stocks/summary', array('method' => 'get')) ?>
            <table>
                <tr>
                    <td>  <label>From Article:</label></td>
                    <td><?php echo form_input('from_article', set_value('from_article', $from_article), 'data-url="/relax/ajax/articles"') ?></td>

                    <td><label>To Article:</label></td>
                    <td><?php echo form_input('to_article', set_value('to_article', $to_article), 'data-url="/relax/ajax/articles"') ?></td>

                    <td><input type="submit" value="Search" /></td>
                </tr>
            </table>
        </div>
    </div>
    <table cellspacing="0">
        <tr>
            <th width="116" align="left"><span class="margin-left5"> Serie 1</span></th>
            <th width="49">16</th>
            <th width="39">17</th>
            <th width="39">18</th>
            <th width="39">19</th>
            <th width="40">20</th>
            <th width="39">21</th>
            <th width="39">22</th>
            <th width="39">23</th>
            <th width="39">24</th>
            <th width="39">25</th>
            <th width="40">26</th>
            <th width="40">27</th>
            <th width="40">28</th>
            <th width="40"></th>

        </tr>
        <tr>
            <th align="left"><span class="margin-left5">Serie 2</span></th>
            <th>27</th>
            <th>28</th>
            <th>29</th>
            <th>30</th>
            <th>31</th>
            <th>32</th>
            <th>33</th>
            <th>34</th>
            <th>35</th>
            <th>36</th>
            <th>37</th>
            <th>38</th>
            <th>39</th>
            <th></th>
        </tr>
        <tr>
            <th align="left"><span class="margin-left5">Serie 3/4/5</span></th>
            <th>35</th>
            <th>36</th>
            <th>37</th>
            <th>38</th>
            <th>39</th>
            <th>40</th>
            <th>41</th>
            <th>42</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th align="left"><span class="margin-left5">Serie 7</span></th>
            <th>39</th>
            <th>40</th>
            <th>41</th>
            <th>41.5</th>
            <th>42</th>
            <th>42.5</th>
            <th>43</th>
            <th>43.5</th>
            <th>44</th>
            <th>45</th>
            <th>46</th>
            <th>47</th>
            <th>48</th>
            <th></th>
        </tr>
        <tr>
            <th  align="left"><span class="margin-left5">Serie 9</span></th>
            <th>BB</th>
            <th>0</th>
            <th>2</th>
            <th>4</th>
            <th>6</th>
            <th>8</th>
            <th>10</th>
            <th>10.5</th>
            <th>11</th>
            <th>12</th>
            <th>14</th>
            <th></th>
            <th></th>
            <th>Total</th>
        </tr>
    </table>
    <div style="width:950px; overflow: auto; height: 350px">
        <table cellspacing="0">


            <?php
            $r = 0;
            $purchaseprice=0;
            $total = 0;
            
            $totals = array(
                'shoes' => 0,
                'accessories' => 0,
                'bags' => 0,
                'bas' => 0
            );
            $counts = array(
                'shoes' => 0,
                'accessories' => 0,
                'bags' => 0,
                'bas' => 0
            );
            ?>
            <?php
            foreach ($result as $row) :
                $total = $row->qty1 + $row->qty2 + $row->qty3 + $row->qty4 + $row->qty5 + $row->qty6 + $row->qty7 + $row->qty8 + $row->qty9 + $row->qty10 + $row->qty11 + $row->qty12 + $row->qty13;
                $purchaseprice = $purchaseprice + ($row->purchase_price*$total);
                
                    

                if (
                        strpos($row->article_code, '1') === 0 ||
                        strpos($row->article_code, '2') === 0 ||
                        strpos($row->article_code, '3') === 0 ||
                        strpos($row->article_code, '4') === 0 ||
                        strpos($row->article_code, '5') === 0 ||
                        strpos($row->article_code, '7') === 0
                ) {
                    $counts['shoes'] += $total;
                    $totals['shoes'] += $total * $row->sale_price;
                } else if (strpos($row->article_code, '6') === 0) {
                    $counts['accessories'] += $total;
                    $totals['accessories'] += $total * $row->sale_price;
                } else if (strpos($row->article_code, '8') === 0) {
                    $counts['bags'] += $total;
                    $totals['bags'] += $total * $row->sale_price;
                } else if (strpos($row->article_code, '9') === 0) {
                    $counts['bas'] += $total;
                    $totals['bas'] += $total * $row->sale_price;
                }
                ?>
            <?php if ($total != 0){ ?>
                <tr align="center" class="row<?php echo $r ?>">
                    <td width="50"><a href="<?php echo config_item('base_url') ?>articles/view/<?php echo $row->article_id ?>"><?php echo $row->article_code ?></a></td>
                    <td width="50"><?php echo $row->sale_price ?></td>
                    <td width="50"><?php echo $row->qty1 ?></td>
                    <td width="40"><?php echo $row->qty2 ?></td>
                    <td width="40"><?php echo $row->qty3 ?></td>
                    <td width="40"><?php echo $row->qty4 ?></td>
                    <td width="40"><?php echo $row->qty5 ?></td>
                    <td width="40"><?php echo $row->qty6 ?></td>
                    <td width="40"><?php echo $row->qty7 ?></td>
                    <td width="40"><?php echo $row->qty8 ?></td>
                    <td width="40"><?php echo $row->qty9 ?></td>
                    <td width="40"><?php echo $row->qty10 ?></td>
                    <td width="40"><?php echo $row->qty11 ?></td>
                    <td width="40"><?php echo $row->qty12 ?></td>
                    <td width="40"><?php echo $row->qty13 ?></td>
                    <td width="40"><b><?php echo $total ?></b></td>
                    <td><?php echo $total * $row->sale_price ?> </td>
                    
                </tr>

                <?php
                $r = 1 - $r;
            }
            endforeach
            ?>
            </table>
    </div>

    <table>
        <tr>
            <th>Shoes</th>
            <td><?php echo number_format($counts['shoes']) ?></td>
            <td><?php echo number_format($totals['shoes']) ?></td>
            <td></td>
            <th>Accessories</th>
            <td><?php echo number_format($counts['accessories']) ?></td>
            <td><?php echo number_format($totals['accessories']) ?></td>
            <td></td>
            <th>Bags</th>
            <td><?php echo number_format($counts['bags']) ?></td>
            <td><?php echo number_format($totals['bags']) ?></td>
            <td></td>
            <th>Bas</th>
            <td><?php echo number_format($counts['bas']) ?></td>
            <td><?php echo number_format($totals['bas']) ?></td>
            <th>P.P.</th>
            <td><?php echo $purchaseprice; ?></td>

        </tr>

    </table>


</div>