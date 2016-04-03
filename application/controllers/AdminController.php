<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function allcountryAction()
    {
        $country_obj= new Application_Model_Country();
        $all_country= $country_obj->all_country();
        $this->view->countries = $all_country;
    }

    public function onecountryAction()
    {
        $country_obj= new Application_Model_Country();
        $country_id=$this->_request->getParam("id");
        $one_country=$country_obj->one_country($country_id);
         $this->view->country = $one_country;
    }

    public function removecountryAction()
    {
        $country_obj= new Application_Model_Country();
        $country_id= $this->_request->getParam("id");
        $delete_country=$country_obj->remove_country($country_id);
        $this->redirect("/admin/allcountry");
    }

    public function addcountryAction()
    {
        $form = new Application_Form_Add();
        $country_obj= new Application_Model_Country();
        $this->view->add_form=$form;
        $request= $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $load =new Zend_File_Transfer_Adapter_Http();
                //$image=$_FILES['image']['name'];
                $load->addFilter('Rename','/var/www/html/visit/public/images/country/'.$_POST['name'].'.jpg');
                $load->receive();
                $_POST['image']='/images/country/'.$_POST['name'].'.jpg';
                $country_obj->add_country($_POST);
                $this->redirect("/admin/allcountry");
            }
        }
    }

    public function editcountryAction()
    {
        $form = new Application_Form_Add();
        $country_obj= new Application_Model_Country();
        $country_id=$this->_request->getParam("id");
        $editcountry= $country_obj->one_country($country_id);
        $form->populate($editcountry[0]);
        $this->view->editform=$form;
         $request = $this->getRequest();
         if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $country_obj->edit_country($country_id,$_POST);
                $this->redirect("/admin/allcountry");
            }
        }
    }

    public function allcityAction()
    {
        $city_obj= new Application_Model_City();
        $country_obj= new Application_Model_Country();
        $country_id= $this->_request->getParam("id");
//$city=$city_obj->get_city_obj_by_country_id(1);
$posts_of_user_id =$country_obj->find_all_country_city($country_id);


        // foreach ($posts_of_user_id as $key=>$value) {
        //     $cities[$key]['name'] = $value->name;
        //     $cities[$key]['description'] = $value->description;
        // }

        // $this->view->posts= $posts;
        // $all_city= $city_obj->all_city($country_id);
        $this->view->cities = $posts_of_user_id;
    }

    public function onecityAction()
    {
        $city_obj= new Application_Model_City();
        $city_id= $this->_request->getParam("id");
        $one_city= $city_obj->one_city($city_id);
        $this->view->city = $one_city;
    }

    public function removecityAction()
    {
        $city_obj= new Application_Model_City();
        $city_id= $this->_request->getParam("id");
        $one_city= $city_obj->remove_city($city_id);
        $this->redirect("/admin/allcity");
    }

    public function editcityAction()
    {
        $form = new Application_Form_Addcity();
        $city_obj= new Application_Model_City();
        $city_id=$this->_request->getParam("id");
        $editcity= $city_obj->one_city($city_id);
        $form->populate($editcity[0]);
        $this->view->editform=$form;
         $request = $this->getRequest();
         if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $city_obj->edit_city($city_id,$_POST);
                $this->redirect("/admin/allcity");
            }
        }
    }

    public function addcityAction()
    {
        $form = new Application_Form_Addcity();
        $city_obj= new Application_Model_City();
         $country_id= $this->_request->getParam("id");
        $this->view->add_form=$form;
        $request= $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $load =new Zend_File_Transfer_Adapter_Http();
                //$image=$_FILES['image']['name'];
                $load->addFilter('Rename','/var/www/html/visit/public/images/city/'.$_POST['name'].'.jpg');
                $load->receive();
                $_POST['image']='/images/city/'.$_POST['name'].'.jpg';
                $_POST['country_id']=$country_id;
                $city_obj->add_city($_POST);
                $this->redirect("/admin/allcity");
            }
        }
    }


}





















