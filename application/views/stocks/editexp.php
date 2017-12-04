<h1 id="title">Edit the Expedier</h1>


<div id="diverror">
<?php echo validation_errors(); ?>
</div>

<div id="toolbox" class="noprint">

</div>
<table cellpadding="0" cellspacing="0">
<?php echo form_open('/stocks/editexp/' .$stock->id) ?>

    <tr>
        <td>
     <table cellpadding="0" cellspacing="0">
    <tr>
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
        <th align="left">Serie 2</th>
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
    </tr>
    <tr>
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
<!-- new table -->
    <tr align="center">
        <td><?php echo form_input('article_id', set_value('article_id', $stock->article_id)) ?></td>
        <td><?php echo form_input('qty1', set_value('qty1', $stock->qty1)) ?></td>
        <td><?php echo form_input('qty2', set_value('qty2', $stock->qty2)) ?></td>
        <td><?php echo form_input('qty3', set_value('qty3', $stock->qty3)) ?></td>
        <td><?php echo form_input('qty4', set_value('qty4', $stock->qty4)) ?></td>
        <td><?php echo form_input('qty5', set_value('qty5', $stock->qty5)) ?></td>
        <td><?php echo form_input('qty6', set_value('qty6', $stock->qty6)) ?></td>
        <td><?php echo form_input('qty7', set_value('qty7', $stock->qty7)) ?></td>
        <td><?php echo form_input('qty8', set_value('qty8', $stock->qty8)) ?></td>
        <td><?php echo form_input('qty9', set_value('qty9', $stock->qty9)) ?></td>
        <td><?php echo form_input('qty10', set_value('qty10', $stock->qty10)) ?></td>
        <td><?php echo form_input('qty11', set_value('qty11', $stock->qty11)) ?></td>
        <td><?php echo form_input('qty12', set_value('qty12', $stock->qty12)) ?></td>
        <td><?php echo form_input('qty13', set_value('qty13', $stock->qty13)) ?></td>


    </tr>



</table>

        </td>

        <td>
                       
            <input type="submit" value="Update" />
        </td>
    </tr>
<?php echo form_close() ?>
</table>
