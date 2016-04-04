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

    public function addlocationAction()
    {
        // action body
        $post_obj = new Application_Model_Location();
        $form = new Application_Form_Addlocation();
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $load=new Zend_File_Transfer_Adapter_Http();
                $load->addFilter('Rename','/var/www/html/zend_pro/public/images/location/'.$_POST['name'].'.jpg');
                $load->receive();
                $_POST['city_id']=1;
                $_POST['image']='/images/location/'.$_POST['name'].'.jpg';
                $post_obj->add_location($_POST);
                $this->redirect('/admin/show');
            }
        }
        $this->view->myform = $form;
    }


}



