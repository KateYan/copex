<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/6/2015
 * Time: 7:19 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Picupload extends CI_Model{

    var $upload_path;

    function __construct(){
        parent::__construct();

        $this->upload_path = realpath(APPPATH.'../upload');
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
        $img_data = $this->upload->data();

    }
}