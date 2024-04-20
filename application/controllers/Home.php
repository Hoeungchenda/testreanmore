<?php 
class Home extends CI_Controller{
    function index($x='') {
        $data = [];
        $data ['title']= "well come to ci";
        $data['name'] = "sok cheata";
        $data ['x'] = $x;
        $this ->load->view('home',$data);
    }
}