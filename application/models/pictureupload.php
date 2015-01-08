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
            'allowed_types' => 'jpg|jpeg',
            'overwrite' => FALSE,
            'max_size' => 2048,
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
        $config1['maintain_ratio'] = TRUE;
        if(($width/$height)<=(395/165)){
            $config1['master_dim'] = 'width';
        }else{
            $config1['master_dim'] = 'height';
        }

        $config1['width'] = '395';
        $config1['height'] = '165';

        $this->reSize($config1);


        // 2. crop for recommend food
        $config2['source_image'] = $this->picture_recomd_path."/$file_name";
        $config2['maintain_ratio'] = false;
        if(($width/$height)<=(395/165)){
            $config2['y_axis'] = floor(($height*395/$width-165)/2);
        }else{
            $config2['x_axis'] = floor(($width*165/$height-395)/2);
        }

        $config2['width'] = '395';
        $config2['height'] = '165';

        $this->cropFood($config2);

        // 3.resize for normal food
        $config3['source_image'] = $image_data['full_path'];
        $config3['new_image'] = $this->picture_normal_path;
        $config3['maintain_ratio'] = TRUE;
        if(($width/$height)<=(190/215)){
            $config3['master_dim'] = 'width';
        }else{
            $config3['master_dim'] = 'height';
        }

        $config3['width'] = '190';
        $config3['height'] = '215';

        $this->reSize($config3);

        // 4. crop for recommend food
        $config4['source_image'] = $this->picture_normal_path."/$file_name";
        $config4['maintain_ratio'] = false;
        if(($width/$height)<=(190/215)){
            $config4['y_axis'] = floor(($height*190/$width-215)/2);
        }else{
            $config4['x_axis'] = floor(($width*215/$height-190)/2);
        }

        $config4['width'] = '190';
        $config4['height'] = '215';

        $this->cropFood($config4);

        return $this;
    }

    public function do_upload_sidedish(){

//        $error = array();
        $config = array(
            'upload_path' => './upload/side/',
            'allowed_types' => 'jpg|jpeg',
            'overwrite' => FALSE,
            'max_size' => 2048,
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
//        $config1['new_image'] = $this->picture_recomd_path;
        $config1['maintain_ratio'] = TRUE;
        if(($width/$height)<=(260/130)){
            $config1['master_dim'] = 'width';
        }else{
            $config1['master_dim'] = 'height';
        }

        $config1['width'] = '260';
        $config1['height'] = '130';

        $this->reSize($config1);


        // 2. crop for side dish
        $config2['source_image'] = $this->picture_side_path."/$file_name";
        $config2['maintain_ratio'] = false;
        if(($width/$height)<=(260/130)){
            $config2['y_axis'] = floor(($height*260/$width-130)/2);
        }else{
            $config2['x_axis'] = floor(($width*130/$height-260)/2);
        }

        $config2['width'] = '260';
        $config2['height'] = '130';

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