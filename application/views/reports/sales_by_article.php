<div class="articles-listing">
    <div id="toolbox">
    	<?php echo form_open('/reports/salesbyarticle', array('method'=>'get')) ?>
    </div>

    <h1 id="title"><?php echo 'Sales By Article';?></h1>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
        <td> <label>From Date:</label>
        <?php echo form_input('from', set_value('from', !empty($from)?$from:date('Y-m-d')) ,'class="date"')?>
        </td>
        <td><label>To Date:</label>
         <?php echo form_input('to', set_value('to', !empty($to)?$to:date('Y-m-d')) ,'class="date"')?>
         
        </td>
        <td><label>From Article:</label>
         <?php echo form_input('from_article', set_value('from_article', $from_article),'data-url="/relax/ajax/articles"') ?>
        </td>
        <td><label>To Article:</label>
         <?php echo form_input('to_article', set_value('to_article', $to_article),'data-url="/relax/ajax/articles"') ?>
        </td>
        <td><input type="submit" value="Search" /></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="970">
        <tr>
            <th width="80"></th>
            <th width="110" align="left">Serie 1</th>
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
        </tr>

        <?php $r = 0 ?>
        <?php foreach ($result as $row) :
           // $total = $row->q1 + $row->q2 + $row->q3 + $row->q4 + $row->q5 + $row->q6 + $row->q7 + $row->q8 + $row->q9 + $row->q10 + $row->q11 + $row->q12 + $row->q13
            ?>
        <tr align="center" class="row<?php echo $r ?>">
            <td><b><?php echo $row->ARTICLE_ID ?></b></td>
            <td><b><?php echo $row->TOTAL  ?></b></td>
            <td><?php echo $row->QTY1 ?></td>
            <td><?php echo $row->QTY2 ?></td>
            <td><?php echo $row->QTY3 ?></td>
            <td><?php echo $row->QTY4 ?></td>
            <td><?php echo $row->QTY5 ?></td>
            <td><?php echo $row->QTY6 ?></td>
            <td><?php echo $row->QTY7 ?></td>
            <td><?php echo $row->QTY8 ?></td>
            <td><?php echo $row->QTY9 ?></td>
            <td><?php echo $row->QTY10 ?></td>
            <td><?php echo $row->QTY11 ?></td>
            <td><?php echo $row->QTY12 ?></td>
            <td><?php echo $row->QTY13 ?></td>
        </tr>
        <?php $r = 1 - $r;endforeach?>
    </table>
      <?php echo form_close() ?>
</div>