<?php if($stockId==1){$stockname = "Relax";}
                if($stockId==2){$stockname = "Solderie";}
                if($stockId==3){$stockname = "Depot";}
		$title = 'Add Articles to '.$stockname.' Stock';?>
<h1 id="title"><?php echo $title;?></h1>


<div id="diverror">
<?php echo validation_errors(); ?>
</div>

<div id="toolbox" class="noprint">

</div>
<table cellpadding="0" cellspacing="0" width="100%">
<?php echo form_open('/stocks/insert/'.$stockId) ?>
    <tr>
        <td>
            <label>Date:</label>
             <?php echo form_input('inserteddate', set_value('inserteddate', !empty($inserteddate)?$inserteddate:date('Y-m-d')) , 'disabled="disabled"') ?>
<?php //echo form_input('inserteddate', set_value('inserteddate', !empty($inserteddate)?$inserteddate:date('Y-m-d')) ,'class="date"')?><br>
<b><label>Article</label><?php echo form_input('article_id', set_value('article_id')) ?></b>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>
     <table cellpadding="0" cellspacing="0" width="970">
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
    
    <tr align="center">
        <td><?php echo form_input('tot', set_value('tot')) ?></td>
        <td><b><?php echo form_input('qty1', set_value('qty1')) ?></b></td>
        <td><?php echo form_input('qty2', set_value('qty2')) ?></td>
        <td><?php echo form_input('qty3', set_value('qty3')) ?></td>
        <td><?php echo form_input('qty4', set_value('qty4')) ?></td>
        <td><?php echo form_input('qty5', set_value('qty5')) ?></td>
        <td><?php echo form_input('qty6', set_value('qty6')) ?></td>
        <td><?php echo form_input('qty7', set_value('qty7')) ?></td>
        <td><?php echo form_input('qty8', set_value('qty8')) ?></td>
        <td><?php echo form_input('qty9', set_value('qty9')) ?></td>
        <td><?php echo form_input('qty10', set_value('qty10')) ?></td>
        <td><?php echo form_input('qty11', set_value('qty11')) ?></td>
        <td><?php echo form_input('qty12', set_value('qty12')) ?></td>
        <td><?php echo form_input('qty13', set_value('qty13')) ?></td>

    </tr>


    
</table>

        </td>

        <td>
            <label>Note</label>
            <textarea name="note" cols="20" rows="10"></textarea>
            <input type="submit" value="Insert Article" />
        </td>
    </tr>
<?php echo form_close() ?>
</table>

<script type="text/javascript">

$('#insertForm').submit(function(e){
     // Capture the entered values of the input boxes
        var tot = document.getElementById('tot').value;
        var qty1 = document.getElementById('qty1').value;
        var qty2 = document.getElementById('qty2').value;
        var qty3 = document.getElementById('qty3').value;
        var qty4 = document.getElementById('qty4').value;
        var qty5 = document.getElementById('qty5').value;
        var qty6 = document.getElementById('qty6').value;
        var qty7 = document.getElementById('qty7').value;
        var qty8 = document.getElementById('qty8').value;
        var qty9 = document.getElementById('qty9').value;
        var qty10 = document.getElementById('qty10').value;
        var qty11 = document.getElementById('qty11').value;
        var qty12 = document.getElementById('qty12').value;
        var qty13 = document.getElementById('qty13').value;

var sum = parseInt(qty1) + parseInt(qty2) + parseInt(qty3) + parseInt(qty4)
            + parseInt(qty5) + parseInt(qty6) + parseInt(qty7) + parseInt(qty8) +
            parseInt(qty9) + parseInt(qty10) + parseInt(qty11) + parseInt(qty12) + parseInt(qty13);

	if(tot!=sum){
		alert('False');
		return false;
	}

	if( $('[name^=qty]').filter( function(){ return $(this).val()==0} ).length == $('[name^=qty]').length ){
		alert("Please fill the quantities");
		e.preventDefault();
		return false;
	}

})
</script>