<?php 
    class User extends CI_Controller{
        public function  __construct(){
            parent:: __construct();
            $this->load->model('user_model');
        }

        function index() {
            $data['userlist'] = $this->user_model->index()->result();

            $this->load->view('user', $data);
        }
        function view($x = '') {
           $data['condition'] =array('id'=>$x);
            $result = $this->user_model->view($data);     
            $data =array('index'=>$result);
            $this->load->view('user_edit',$data);
        }
        // new update by chatgpt4
        public function insert() {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'age' => $this->input->post('age')
            );
            $result = $this->user_model->insert($data);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Student inserted successfully!'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to insert student!'));
            }
        }
        
        function update () {
                $id = Null;
                $name = Null ;
                $email = Null ;
                $age = Null;

                extract($_POST);
        //      var_dump($user_name);
                $param['user_id'] = $id;
                $param['user_name'] = $name;
                $param['user_email'] = $email;
                $param['user_age'] = $age;
                $result =$this->user_model->update($param);
                if($result) {
                    echo json_encode(array('success' => true, 'message' => 'Student inserted successfully!'));
                }else{
                    echo json_encode(array('success' => false, 'message' => 'Failed to insert student!'));
                }
        }
        public function delete($id) {
            $result = $this->user_model->delete($id);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Student deleted successfully!'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to delete student!'));
            }
        }
    }
