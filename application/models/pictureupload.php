<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/6/2015
 * Time: 7:19 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pictureupload extends CI_Model{

    var $picture_path;

    function __construct(){
        parent::__construct();

        $this->picture_path = realpath(APPPATH.'../upload');
    }

    function do_upload(){

        $config = array(
            'upload_path' => './upload/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => FALSE,
            'max_size' => 2048,
            'max_width' => 1024,
            'max_height' => 768,
        );
        $this->load->library('upload',$config);
        $this->upload->do_upload();
        $image_data = $this->upload->data();
        $width = $image_data['image_width'];
        $height = $image_data['image_height'];

       // 1.resize
        $config1['source_image'] = $image_data['full_path'];

        $config1['maintain_ratio'] = TRUE;
        if($width <= $height){
            $config1['master_dim'] = 'width';
        }else{
            $config1['master_dim'] = 'height';
        }

        $config1['width'] = '395';
        $config1['height'] = '165';

        $this->reSize($config1);


        // 2. crop for recommend food
        $config2['image_library'] = 'gd2';
        $config2['source_image'] = $image_data['full_path'];
        $config2['new_image'] = $this->picture_path.'\recommend';
        $config2['maintain_ration'] = false;
        if($width <= $height){
            $config2['y_axis'] = floor(($height*395/$width-165)/2);
        }else{
            $config2['x_axis'] = floor(($width*165/$height-395)/2);
        }

        $config2['width'] = '395';
        $config2['height'] = '165';

        $error = $this->cropFood($config2);
        return $error;
////        $this->cropFood($config2);
//        $this->load->library('image_lib',$config2);
//        $this->image_lib->crop();
//        $config_rec['width'] = '395';
//        $config_rec['height'] = '165';
//        $config2['source_image'] = $image_data['full_path'];
//        $config1['new_image'] = $this->picture_path.'/recommend';

//        $this->load->library('image_lib',$config2);
//        if(!$this->image_lib->crop()){
//
//            $error = $this->image_lib->display_errors();
//            return $error;
//        }


    }

    public function reSize($config){
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();
    }
    public function cropFood($config){
        $this->load->library('image_lib',$config);
//        $this->image_lib->crop();
        if(!$this->image_lib->crop()){

            $error = $this->image_lib->display_errors();
            return $error;
        }
    }
}