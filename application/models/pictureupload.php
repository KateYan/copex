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
    var $picture_recomd_path;
    var $picture_normal_path;
    var $picture_side_path;
    var $file_name;

    function __construct(){
        parent::__construct();

        $this->picture_path = realpath(APPPATH.'../upload');
        $this->picture_recomd_path = realpath(APPPATH.'../upload/recommend');
        $this->picture_normal_path = realpath(APPPATH.'../upload/normal');
        $this->picture_side_path = realpath(APPPATH.'../upload/side');
    }

    public function do_upload(){
//        $error = array();
        $config = array(
            'upload_path' => './upload/',
            'allowed_types' => 'gif|jpg|jpeg|jpe|png',
            'overwrite' => FALSE,
            'max_size' => 0,
            'max_width' => 0,
            'max_height' => 0,
        );
        $this->load->library('upload',$config);

        if(!$this->upload->do_upload()){
            $error = $this->upload->display_errors();
            return $error;
        }
//        $this->upload->do_upload();
        $image_data = $this->upload->data();
        $file_name = $image_data['file_name'];
        $file_path = $image_data['file_path'];
        $width = $image_data['image_width'];
        $height = $image_data['image_height'];

        $this->file_name = $file_name;

       // 1.resize for recommend food
        $config1['source_image'] = $image_data['full_path'];
        $config1['new_image'] = $this->picture_recomd_path;
        $config1['quality'] = 100;
        $config1['maintain_ratio'] = TRUE;
        if(($width/$height)<=(790/330)){
            $config1['master_dim'] = 'width';
        }else{
            $config1['master_dim'] = 'height';
        }

        $config1['width'] = '790';
        $config1['height'] = '330';

        $this->reSize($config1);


        // 2. crop for recommend food
        $config2['source_image'] = $this->picture_recomd_path."/$file_name";
        $config2['maintain_ratio'] = false;
        if(($width/$height)<=(790/330)){
            $config2['y_axis'] = floor(($height*790/$width-330)/2);
        }else{
            $config2['x_axis'] = floor(($width*330/$height-790)/2);
        }

        $config2['width'] = '790';
        $config2['height'] = '330';

        $this->cropFood($config2);

        // 3.resize for normal food
        $config3['source_image'] = $image_data['full_path'];
        $config3['new_image'] = $this->picture_normal_path;
        $config3['quality'] = 100;
        $config3['maintain_ratio'] = TRUE;
        if(($width/$height)<=(380/430)){
            $config3['master_dim'] = 'width';
        }else{
            $config3['master_dim'] = 'height';
        }

        $config3['width'] = '380';
        $config3['height'] = '430';

        $this->reSize($config3);

        // 4. crop for recommend food
        $config4['source_image'] = $this->picture_normal_path."/$file_name";
        $config4['maintain_ratio'] = false;
        if(($width/$height)<=(380/430)){
            $config4['y_axis'] = floor(($height*380/$width-430)/2);
        }else{
            $config4['x_axis'] = floor(($width*430/$height-380)/2);
        }

        $config4['width'] = '380';
        $config4['height'] = '430';

        $this->cropFood($config4);

        return $this;
    }

    public function do_upload_sidedish(){

//        $error = array();
        $config = array(
            'upload_path' => './upload/side/',
            'allowed_types' => 'gif|jpg|jpeg|jpe|png',
            'overwrite' => FALSE,
            'max_size' => 0,
            'max_width' => 0,
            'max_height' => 0,
        );
        $this->load->library('upload',$config);

        if(!$this->upload->do_upload()){
            $error = $this->upload->display_errors();
            return $error;
        }
        $image_data = $this->upload->data();
        $file_name = $image_data['file_name'];
        $width = $image_data['image_width'];
        $height = $image_data['image_height'];

        $this->file_name = $file_name;

        // 1.resize for recommend food
        $config1['source_image'] = $image_data['full_path'];
        $config1['quality'] = 100;
//        $config1['new_image'] = $this->picture_recomd_path;
        $config1['maintain_ratio'] = TRUE;
        if(($width/$height)<=(520/260)){
            $config1['master_dim'] = 'width';
        }else{
            $config1['master_dim'] = 'height';
        }

        $config1['width'] = '520';
        $config1['height'] = '260';

        $this->reSize($config1);


        // 2. crop for side dish
        $config2['source_image'] = $this->picture_side_path."/$file_name";
        $config2['maintain_ratio'] = false;
        if(($width/$height)<=(520/260)){
            $config2['y_axis'] = floor(($height*520/$width-260)/2);
        }else{
            $config2['x_axis'] = floor(($width*260/$height-520)/2);
        }

        $config2['width'] = '520';
        $config2['height'] = '260';

        $this->cropFood($config2);
        return $this;
    }

    public function reSize($config){
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);

        if(!$this->image_lib->resize()){
        }
//        $this->image_lib->resize();
    }
    public function cropFood($config){
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
//        $this->image_lib->crop();
        if(!$this->image_lib->crop()){

            $error = $this->image_lib->display_errors();
            return $error;
        }
    }
}