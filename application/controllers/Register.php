<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Foodies_Controller {

    public $viewData = array();

    function __construct() {
        parent::__construct();
        $this->load->model("User_model","User");
    }

    public function index() {

        $title = "Register";

        $this->viewData['page'] = "register";
        $this->viewData['title'] = $title;
        $this->viewData['module'] = "Register";

        $this->load->model("City_model","City");
        $this->viewData['citydata'] = $this->City->getCityData(array("stateid IN (SELECT id FROM province WHERE countryid=101)"=>null),array("name"=>"ASC"));

        $this->foodies_headerlib->add_stylesheet("bootstrap-datepickercss","bootstrap-datepicker.css");
        $this->foodies_headerlib->add_javascript_plugins("bootstrap-datepicker","bootstrap-datepicker/js/bootstrap-datepicker.js");
        $this->load->view('Register', $this->viewData);
    }

    public function new_register(){

		$PostData = $this->input->post();
        
        $usertype = trim($PostData['usertype']);
		$fullname = trim($PostData['fullname']);
		$mobilenumber = trim($PostData['mobilenumber']);
        $email = trim($PostData['email']);
        // $password = trim($PostData['password']);
        $isagree = isset($PostData['isagree'])?1:0;
        $status = 1;
		$createddate = $this->general_model->getCurrentDateTime();
		
        $Check = $this->User->CheckEmailAvailable($email);
        
        if (empty($Check)) {
            
            $Check = $this->User->CheckMobileNumberAvailable($mobilenumber,1);
            
            if (empty($Check)) {
                
                $insertdata = array(
                    "usertype"=>$usertype,
                    "kitchenname"=>$fullname,
                    "mobilenumber"=>$mobilenumber,
                    "email"=>$email,
                    // "password"=>$password,
                    "isagreeforpolicy"=>$isagree,
                    "userstatus"=>1,
                    "status"=>$status,
                    "createddate"=>$createddate,
                    "modifieddate"=>$createddate
                );
                
                
                $UserRegID = $this->User->Add($insertdata);
                // $UserRegID = 1;
                if($UserRegID){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
        }else{
            echo 3;
        }
	}

    public function new_rider_register(){

		$PostData = $this->input->post();
        
        $usertype = 2;
		$fullname = trim($PostData['riderfullname']);
		$mobilenumber = trim($PostData['ridermobilenumber']);
        $email = trim($PostData['rideremail']);
        $cityid = trim($PostData['ridercity']);
        $biketype = trim($PostData['biketype']);
        $youhavelicense = trim($PostData['youhavelicense']);
        
        $status = 0;
		$createddate = $this->general_model->getCurrentDateTime();
		
        $Check = $this->User->CheckEmailAvailable($email);
        
        if (empty($Check)) {
            $Check = $this->User->CheckMobileNumberAvailable($mobilenumber,2);
            
            if (empty($Check)) {
                if(!is_dir(DOCUMENT_PATH)){
                    @mkdir(DOCUMENT_PATH);
                }
                $extensions= array("jpeg","jpg","png","pdf");
                
                $licencefile = $rcbookfile = $passportfile = $idprooffile = "";
                
                if($_FILES['licencefile']['name'] != ''){
                    $fileext = explode('.',$_FILES['licencefile']['name'])[1];
                    if(in_array($fileext,$extensions)=== true){
                        move_uploaded_file($_FILES['licencefile']['tmp_name'],DOCUMENT_PATH.$_FILES['licencefile']['name']);

                        $licencefile = $_FILES['licencefile']['name'];
                    }
                }
                if($_FILES['rcbookfile']['name'] != ''){
                    $fileext = explode('.',$_FILES['rcbookfile']['name'])[1];
                    if(in_array($fileext,$extensions)=== true){
                        move_uploaded_file($_FILES['rcbookfile']['tmp_name'],DOCUMENT_PATH.$_FILES['rcbookfile']['name']);

                        $rcbookfile = $_FILES['rcbookfile']['name'];
                    }
                }
                if($_FILES['passportfile']['name'] != ''){
                    $fileext = explode('.',$_FILES['passportfile']['name'])[1];
                    if(in_array($fileext,$extensions)=== true){
                        move_uploaded_file($_FILES['passportfile']['tmp_name'],DOCUMENT_PATH.$_FILES['passportfile']['name']);

                        $passportfile = $_FILES['passportfile']['name'];
                    }
                }
                if($_FILES['idprooffile']['name'] != ''){
                    $fileext = explode('.',$_FILES['idprooffile']['name'])[1];
                    if(in_array($fileext,$extensions)=== true){
                        move_uploaded_file($_FILES['idprooffile']['tmp_name'],DOCUMENT_PATH.$_FILES['idprooffile']['name']);

                        $idprooffile = $_FILES['idprooffile']['name'];
                    }
                }
                $insertdata = array(
                    "usertype"=>$usertype,
                    "kitchenname"=>$fullname,
                    "mobilenumber"=>$mobilenumber,
                    "email"=>$email,
                    "cityid"=>$cityid,
                    "biketype"=>$biketype,
                    "youhavelicense"=>$youhavelicense,
                    "licencefile"=>$licencefile,
                    "rcbookfile"=>$rcbookfile,
                    "passportfile"=>$passportfile,
                    "idprooffile"=>$idprooffile,
                    "userstatus"=>0,
                    "status"=>$status,
                    "createddate"=>$createddate,
                    "modifieddate"=>$createddate
                );
                
                
                $UserRegID = $this->User->Add($insertdata);
                // $UserRegID = 1;
                if($UserRegID){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 3;
            }
        }else{
            echo 2;
        }
	}
}