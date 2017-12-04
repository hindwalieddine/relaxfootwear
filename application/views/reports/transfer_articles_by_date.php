<?php $stockname = 'All';
                if($stockId==1){$stockname = "Relax";}
                if($stockId==2){$stockname = "Solderie";}
                if($stockId==3){$stockname = "Depot";}
                $title = 'Report Of Transfered Articles To '.$stockname.' Stock';?>
<h1 id="title"><?php echo $title;?></h1>
<div class="articles-transfer-listing">
    <div id="toolbox" class="noprint">
       <!--
        <div class="filter">
        	    <?php // echo form_dropdown('action',
          //  array('-1'=>'', '1' => 'Insert', '2' => 'Transfer', '3' => 'Expedier'),$actionId,'id="actionFilter"') ?>
               </div>
    	-->
 
 <div class="noprint">
     <?php echo form_open('/reports/transferarticlesbydate', array('method'=>'get')) ?>
    <table>
        <tr>
     <td> <label>From Date:</label></td>
     <td>   <?php echo form_input('from', set_value('from', !empty($from)?$from:date('Y-m-d')) ,'class="date"')?></td>
     <td>    <label>To Date:</label></td>
     <td><?php echo form_input('to', set_value('to', !empty($to)?$to:date('Y-m-d')) ,'class="date"')?></td>
     <td>  <input type="submit" value="Search" />  </td>
        </tr>
    </table>
  </div>
      </div>
    <table cellspacing="0">
       <tr>
            <th width="77"></th>
            <th width="86" align="left">Serie 1</th>
            <th width="37">16</th>
            <th width="38">17</th>
            <th width="38">18</th>
            <th width="38">19</th>
            <th width="38">20</th>
            <th width="38">21</th>
            <th width="38">22</th>
            <th width="38">23</th>
            <th width="38">24</th>
            <th width="38">25</th>
            <th width="38">26</th>
            <th width="38">27</th>
            <th width="38">28</th>
            <th width="20"></th>
            <th width="21"></th>
            <th width="37"></th>
        </tr>
        <tr>
            <th></th>
            <th align="left">Serie 2</th>
            <th>25</th>
            <th>26</th>
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
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th align="left">Serie 3/4/5</th>
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
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th align="left">Serie 7</th>
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
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th align="center">Article Id</th>
            <th align="left">Serie 9</th>
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
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>

    <div style="width:950px; overflow: auto; height: 300px">
    <table cellpadding="0" cellspacing="0">
        <?php $r = 0 ?>
        <?php foreach ($result as $row) :
            $total = $row->qty1 + $row->qty2 + $row->qty3 + $row->qty4 + $row->qty5 + $row->qty6 + $row->qty7 + $row->qty8 + $row->qty9 + $row->qty10 + $row->qty11 + $row->qty12 + $row->qty13
            ?>
        <tr align="center" class="row<?php echo $r ?>">
            <td width="80"><b><?php echo $row->article_id ?></b></td>
            <td width="90"><b><?php echo $row->date  ?></b></td>
            <td width="40"><?php echo $row->qty1 ?></td>
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
            <td width="20"><b><?php echo $total  ?></b></td>
            <td width="10"><?php echo anchor('/stocks/edittrans/'.$row->id, 'Edit') ?></td>
            <td width="10"><?php echo anchor('/stocks/deletetrans/'.$row->id, 'Delete') ?></td>
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
      <?php echo form_close() ?>
    </div>
</div>