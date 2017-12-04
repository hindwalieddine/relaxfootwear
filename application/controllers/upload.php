<?php
class Upload extends CI_Controller {
    public function index(){
        $this->load->view('upload/main_view',array('error'=>''));
        
    }

    public function do_upload(){
       // $url= base_url().'images/';
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['overwrite'] =  true;
        $config['remove_spaces']= true;
        //$config['file_name'] = $article_id;
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload()){
            $error = array('error'=>$this->upload->display_errors());
            $this->load->view(main_view,$error);
            
        }
        else{
           $file_data = $this->upload->data();
           $data['img'] = base_url().'images/'.$file_data['file_name'];
           $this->load->view('upload/success_msg',$data);
           
        }
    }

    public function get_pictures(){
        $aryPhotos  = get_filenames('images');
        //echo $aryPhotos;
        var_dump($aryPhotos);
   
         echo "<br>";
         echo "<br>";

         $arrlength=count($aryPhotos);
         for($x=0;$x<$arrlength;$x++) {
            $str = $aryPhotos[$x];

            //$newvar = str_replace('.jpg','',$aryPhotos[$x]);
            $codePic = preg_replace("/[a-zA-Z\.]/", "", $aryPhotos[$x]);
        
           // var v = $aryPhotos[$x];
           // $newvar = var1.substring(0,6);
            ?>
<img src=<?php base_url()?>'images/<?php echo $codePic ?>' alt="<?php echo $codePic ?>">

             <?php
  }


    }

      public function view_pictures(){  //$fromarticle,$toarticle
          $fromarticle = '1100011';
          $toarticle  = '1501213';
           $info[] =array();
           $data['info'] = array();
           $aryPhotos  = get_filenames('images');
            $arrlength=count($aryPhotos);

         for($x=0;$x<$arrlength;$x++) {
            $str = $aryPhotos[$x];
            
            $codePic = preg_replace("/[a-zA-Z\.]/", "", $aryPhotos[$x]);
            $urlimage = base_url().'images/'.$str;
            if(($codePic>=$fromarticle)&&($codePic<=$toarticle)){ 
               
               $data['info'][$x] = $codePic;

          ?>



<img src="<?php echo $urlimage?>" alt="<?php echo $codePic ?>" width="150" height="150">
  <?php }} var_dump($data['info']);



      }

      public function get_pictures_between_dates($fromarticle,$toarticle){  //
           $info[] =array();
           $aryPhotos  = get_filenames('images');
           $arrlength=count($aryPhotos);

         for($x=0;$x<$arrlength;$x++) {
            $str = $aryPhotos[$x];

            $codePic = preg_replace("/[a-zA-Z\.]/", "", $aryPhotos[$x]);
            $urlimage = base_url().'images/'.$str;
            if(($codePic>=$fromarticle)&&($codePic<=$toarticle)){

               $data['info'][$x] = $codePic;

          ?>

  <?php }} var_dump($data['info']);



      }

    public function delete_all_pics(){
       // delete_files('./path/to/directory/');
    }
}
?>
