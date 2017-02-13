<?php
    Class Main extends CI_Controller {
        public function main(){
            $data['page'] = 'main';
            $this->load->view('menu/content', $data);
        }
    }


?>