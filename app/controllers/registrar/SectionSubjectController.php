<?php
session_start();

require_once __DIR__ . '/../../models/registrar/SectionSubjectModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../controllers/Controller.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class SectionSubjectController extends Controller{
        public function __construct($con){
            parent::__construct(
                new SectionSubjectModel($con)
            );
        }

        public function index(){
            return $this->model->index();
        }

        public function create($data){

        }

        public function update($id, $data){

        }

        public function delete($id){

        }
    }