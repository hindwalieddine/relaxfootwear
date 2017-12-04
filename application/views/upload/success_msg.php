<div style="float:right"> <?php echo anchor('index.php/upload', 'Upload Another Picture') ?></div>
 <html>
    <h1>File has been uploaded</h1>
    <img src="<?php echo $img;?>" width="300" height="300" alt=""/>
   
</html>

<?php

echo "<br>";
  $aryPhotos  = get_filenames('images');
        
        //var_dump($aryPhotos);

         $arrlength=count($aryPhotos);
         for($x=0;$x<$arrlength;$x++) {
            $str = $aryPhotos[$x];

            $codePic = preg_replace("/[a-zA-Z\.]/", "", $aryPhotos[$x]);
            $urlimage = base_url().'images/'.$str;
          ?>

<img src="<?php echo $urlimage?>" alt="<?php echo $codePic ?>" width="100" height="100">
  <?php } ?>

