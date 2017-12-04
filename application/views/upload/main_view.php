<html>
<head>
<title>Upload Form</title>
</head>
<body>

<div id="diverror">
<?php echo $error; ?>
</div>


    	<div id="upload">
		<?php
	        echo form_open_multipart('upload/do_upload'); ?>
             <!--   <input type="file" name="userfile" />
                <input type="submit" name="submit" value="upload image"/> -->

		
		<?php
                
                $data = array(
                'name'        => 'userfile',
                             );
                echo form_upload($data);
		echo form_submit('submit', 'upload image');
                echo form_close();
		?>
     	</div>

</body>
</html>

