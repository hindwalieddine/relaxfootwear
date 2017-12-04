<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Relax Menu</h1>

	<div id="body">
    <!-- create a menu -->

<ul>
	<li>
		<?php echo anchor('suppliers' , 'Suppliers') ?>
        <ul>
        	<li><?php echo anchor('suppliers/create' , 'New Supplier') ?></li>
        </ul>
            </li>
    <li>
		<?php echo anchor('/articles', 'Articles') ?>
        <ul>
            <li><?php echo anchor('/stocks/insert/'.$stockId=1, 'Insert Article to Relax Stock') ?></li>
            <li><?php echo anchor('/stocks/insert/2', 'Insert Article to Solderie Stock') ?></li>
            <li><?php echo anchor('/stocks/insert/3', 'Insert Article to Depot Stock') ?></li>
        </ul> 
       </li>
         
            <li><?php echo anchor('/stocks/summary', 'View All Stocks') ?></li>
            <ul>
            <li><?php echo anchor('/stocks/summary/1', 'View Relax Stock') ?></li>
            <li><?php echo anchor('/stocks/summary/2', 'View Solderie Stock') ?></li>
            <li><?php echo anchor('/stocks/summary/3', 'View Depot Stock') ?></li>
            <li><?php echo anchor('/stocks/search/','Search in Relax Stock') ?></li>
        </ul>
    </li>
    
    <li><?php echo anchor('/stocks/transfer/', 'Transfer') ?>   </li>
    <li><?php echo anchor('/stocks/expedier/', 'Expedier') ?></li>
    <li><?php echo anchor('/invoices/create/', 'Invoice') ?>
       <ul>
           <li><?php echo anchor('/invoices/invoices/?from='. date('Y-m-d') .'&to=' . date('Y-m-d'), 'See All invoices / Search between 2 dates') ?>   </li>
       
       </ul>
    
    
    </li>
    <li>Reports
       <ul>
           <li><?php echo anchor('/reports/salesbyarticle/', 'Sales By Articles') ?>   </li>
           <li><?php echo anchor('reports/insertedarticlesbydate/','Inserted Articles By Date') ?></li>
           <li>Transfer
                   <ul>
                       <li><?php echo anchor('reports/transferarticlesbydate/1','Transfer to Relax') ?></li>
                       <li><?php echo anchor('reports/transferarticlesbydate/2','Transfer to Solderie') ?></li>
                       <li><?php echo anchor('reports/transferarticlesbydate/3','Transfer to Depot') ?></li>
                   </ul>
           </li>
           <li><?php echo anchor('reports/expedierarticlesbydate', 'Expedier') ?></li>

       </ul>


    </li>
    <li><?php echo anchor('index.php/upload', 'Upload Pictures') ?></li>
    
</ul>
      
        
        
    

	</div>

</div>

</body>
</html>