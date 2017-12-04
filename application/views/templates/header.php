<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title ?></title>
        <link href="<?php echo config_item('base_url') ?>themes/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo config_item('base_url') ?>themes/smoothness/jquery-ui-1.9.1.custom.min.css"
        	rel="stylesheet" type="text/css" />
        <script src="<?php echo config_item('base_url') ?>themes/jquery.min.js" type="text/javascript" ></script>
		<script src="<?php echo config_item('base_url') ?>themes/jquery-ui-1.9.1.custom.min.js" type="text/javascript" ></script>
        <script src="<?php echo config_item('base_url') ?>themes/functions.js" type="text/javascript" ></script>
        <script type="text/javascript">var base = '<?php echo site_url() ?>' </script>


        <script>
        $(document).ready(function() {
            $('input:text:visible:enabled:first').focus();
        });
        </script>

    </head>
    <body onLoad="">
        <div id="page" class="block">
             <div id="header" >
                 <a id="logo" style="margin-left:20px;" class="lft">
                     <img src="<?php echo config_item('base_url') ?>themes/images/logo.png" alt="" title="Powered by Hannoud ;)" />
                     <br/> Bakaata El Chouf - Tel: 05/501393 - Mobile: 70/525153
                 </a>

                 <div class="rgt" class="current-time">
                     <div class="noprint">    Welcome <?php echo "Omar" ?> , <?php echo date('m-d-Y h:m:s') ?></div>
                 </div>

                 <div class="clr"></div>
            </div>

        <div id="body">

            <div class="noprint" style="float: right"> <?php echo anchor('', 'Return To Menu') ?></div>
            