<div class="stock-summary">
    <div id="toolbox" class="noprint">
        <?php echo anchor('', 'Return To Menu') ?>
        <div class="filter">
        	Show the summary of 
            <?php echo form_dropdown('stock',
            array('-1'=>'All', '1' => 'Relax', '2' => 'Solderie', '3' => 'Depot'),$stockId,'id="stockFilter"') ?>
        </div>
    </div>
    <table cellspacing="0" width="100%">
        <div style="position: absolute;height: 2000px; top: 0px">
        <tr>
            <th colspan="2" width="110" align="left">Serie 1</th>
            <th width="60">16</th>
            <th width="60">17</th>
            <th width="60">18</th>
            <th width="60">19</th>
            <th width="60">20</th>
            <th width="60">21</th>
            <th width="60">22</th>
            <th width="60">23</th>
            <th width="60">24</th>
            <th width="60">25</th>
            <th width="60">26</th>
            <th width="60">27</th>
            <th width="60">28</th>
            <th></th>
        </tr>
        <tr>
            <th colspan="2" align="left">Serie 2</th>
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
            <th colspan="2" align="left">Serie 3/4/5</th>
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
            <th colspan="2" align="left">Serie 7</th>
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
        <tr>
            <th colspan="2" align="left">Serie 9</th>
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
        </div>
       <div style="height: 0px;top:100px">
        <?php $r = 0; $x=0; $totbas=0; $tot8=0; $tot6=0; $totshoes=0; $totall=0; ?>
        <?php foreach ($result as $row) : ?>
        <tr align="center" class="row<?php echo $r ?>">
            <td><?php echo $row->article_id ?></td>
            <td><?php echo $row->sale_price ?></td>
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
            <?php $tot=$row->qty1 +$row->qty2 +$row->qty3 + $row->qty4 + $row->qty5 +$row->qty6 +$row->qty7 + $row->qty8 + $row->qty9 +$row->qty10 + $row->qty11 +$row->qty12 +$row->qty13; ?>
            <td><b><?php echo $tot ?></b></td>
           <td> <?php
               if($row->article_id>5999999 && $row->article_id<7000000){ $tot6=$tot6+$tot; }
               if($row->article_id>7999999 && $row->article_id<8999999){ $tot8=$tot8+$tot; }
               if($row->article_id>8999999){$totbas=$totbas+$tot;}
               $totall=$totall+$tot;
               $totshoes=$totall-$tot6-$tot8-$totbas;
                echo $mulipletot=$totall*$row->sale_price; ?></td>
                 <?php  $x=$x+$mulipletot;  ?>
        </tr>
        
            <?php $r = 1 - $r;
        endforeach?>

        <tr>
            <td colspan="2"><?php echo "Shoes: ".$totshoes; ?></td>
            <td colspan="2"><?php echo $x;   ?></td>
            <td colspan="2"><?php echo "Accessoire: ".$tot6;?></td>
            <td colspan="2"></td>
            <td colspan="2"><?php echo "Bags: ".$tot8;?></td>
            <td colspan="2"><?php echo $totbas;?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
        </tr>
       </div>
    </table>

</div>