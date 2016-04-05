<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function postrAction()
    {
        // action body
        $post_obj = new Application_Model_Post();
        $posts = $post_obj->getposts_by_city_id(1);
        $comment_obj=new Application_Model_Comment();
       // $comments=$post_obj->getcomments_on_post(1);
        $comments=$comment_obj->get_comments();
        $this->view->pos = $posts;
        $this->view->com=$comments;
    }

    public function postcreateAction()
    {
        // action body
        $form = new Application_Form_Addpost();
        $post_obj = new Application_Model_Post();
    //test case
        /*    $post_obj = new Application_Model_Post();
        $postData['title']="sssss";
        $postData['city_id']=1;
        $postData['user_id']=1;
        $postData['content']="dddssddssddsdsdsdsds";
        $postData['image']="im3";
        $post_obj->create_post($postData);
*/
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $load=new Zend_File_Transfer_Adapter_Http();
                $load->addFilter('Rename','/var/www/html/zend_pro/public/images/post'.$_POST['title'].'.jpg');
                $load->receive();
                //this is to link with city page and userid[session]
                $_POST['user_id']=1;
                $_POST['city_id']=1;
                $_POST['image']='/images/post/'.$_POST['title'].'.jpg';
                $post_obj->create_post($_POST);
                $this->redirect('/user/postr');
            }
        }
        $this->view->myform = $form;

    }

    public function postupdateAction()
    {
        // action body
        $form = new Application_Form_Addpost();
        $post_obj = new Application_Model_Post();
        $id = $this->_request->getParam('id');
        $post_got = $post_obj->getpost_by_postid($id);

        $form->populate($post_got[0]);
        $this->view->form_c = $form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $_POST['user_id']=1;
                $_POST['city_id']=1;
               // var_dump( $_POST);die();
                $post_obj->update_post($_POST);
                $this->redirect('/user/postr');
            }
        }
          /*
                            $post_obj = new Application_Model_Post();

                            $date['id']=12;
                            $date['user_id']=1;
                            $date['city_id']=1;
                            $date['image']="image.jpg";
                            $date['content']="123456789432";
                            $date['title']="update";
                            //var_dump( $date);die();
                            $post_obj->update_post($date);
                            $this->redirect('/user/postr');
        */
    }

    public function postdeleteAction()
    {
        // action body
        $post_obj = new Application_Model_Post();
        $id = $this->_request->getParam('id');
        //echo "$id";
        $post_obj->delete_post($id);


        $this->redirect('/user/postr');

        //test case
     //   $post_obj = new Application_Model_Post();
     //   $post_obj->delete_post(9);
    }

    public function commentdeleteAction()
    {
        // action body
        $comment_obj=new Application_Model_Comment();
        $id=$this->_request->getParam('id');
        //echo $id;die();
        $comment_obj->delete_comment($id);
        $this->redirect('/user/postr');
    }

    public function commentcreateAction()
    {
        // action body
        $form = new Application_Form_Addcomment();
        $post_obj = new Application_Model_Post();
        $comment_obj= new Application_Model_Comment();
        $id=$this->_request->getParam('id');
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $_POST['post_id']=$id;
                $_POST['user_id']=1;
                $comment_obj->create_comment($_POST);
                $this->redirect('/user/postr');
            }
        }
        //$this->view-> post_to_comment ->$post_obj->getpost_by_postid($id);
        $this->view->myform = $form;

    }

    public function mapAction()
    {
        // action body
        $city_obj = new Application_Model_Comment();

    }

    public function makeReservationAction()
    {
        $HreservForm=new Application_Form_HotelReservation();
        $this->view->hotelreservform=$HreservForm;
        $user_id= $this->_request->getParam("id");

        $request=$this->getRequest();
        $hotelReservation_model = new Application_Model_HotelReservation();
        if($request->isPost()){
            if($HreservForm->isValid($request->getPost())){
                $data['name']=$_POST['name'];
                $data['from']=$_POST['from'];
                $data['to']=$_POST['to'];
                $data['member']=$_POST['member'];
                $data['user_id']=$user_id;
                $hotelReservation_model->addReservation($data);
              //  $redirect="/user/get-reservations/id/".$user_id;
                $this->redirect("/user/get-reservations/id/$user_id");

            }
        }
    }

    public function getReservationsAction()
    {
        $user_id= $this->_request->getParam("id");
        $model=new Application_Model_HotelReservation();

        $reservs=$model->getUserReservation($user_id);
        $this->view->reservers=$reservs;
    }

    public function makeCarReservAction()
    {
        $CreservForm= new Application_Form_CarReservation();
        $this->view->carform=$CreservForm;

        $request=$this->getRequest();
        $carReservModel= new Application_Model_CarReservation();
        $user_id= $this->_request->getParam("id");
        if($request->isPost()){
            if($CreservForm->isValid($request->getPost())) {
                $data['from'] = $_POST['from'];
                $data['to'] = $_POST['to'];
                $data['location'] = $_POST['location'];
                $data['user_id'] = $user_id;
                $carReservModel->reserveCar($data);
                $this->redirect("/user/get-car-reservation/id/$user_id");
            }
        }
    }

    public function getCarReservationAction()
    {
        $user_id= $this->_request->getParam("id");
        $carReservModel= new Application_Model_CarReservation();
        $rents=$carReservModel->getUserReservation($user_id);
        $this->view->rents=$rents;
    }

    public function updateRentAction()
    {
        $rent_id= $this->_request->getParam("id");
        $form=new Application_Form_UpdateRent();
        $model= new Application_Model_CarReservation();
        $rent=$model->getOneRent($rent_id);
        $user_id=$rent[0]['user_id'];
        $form->populate($rent[0]);
        $this->view->Form=$form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $model->updateRent($_POST,$rent_id);
                $this->redirect('/user/get-car-reservation/id/'.$user_id);
            }
        }
    }

    public function deleterentAction()
    {
        // when session is available
        /*
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead)) {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }
        */
        $rent_id= $this->_request->getParam("id");
        $model = new Application_Model_CarReservation();
        $model->cancelReservation($rent_id);
        //$this->redirect('/visit/get-car-reservation/id/'.$user_id);
    }

    public function updateReservationAction()
    {
        $reservation_id= $this->_request->getParam("id");
        $form= new Application_Form_UpdateReservation();

        $model= new Application_Model_HotelReservation();
        $reservation = $model->getOneReservation($reservation_id);
        $form->populate($reservation);
        $this->view->form=$form;

        // when session is available
        /*
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead)) {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }
        */

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $data['name']=$_POST['id'];
                $data['from']=$_POST['from'];
                $data['to']=$_POST['to'];
                $data['member']=$_POST['member'];
                /*session*/
                //$data['user_id']=$user_id;
                $model->editReservation($data,$reservation_id);
                //$this->redirect("/get-reservations/id/$user_id");
            }
        }
    }

    public function deletereservationAction()
    {
        $reservation_id= $this->_request->getParam("id");
        $model= new Application_Model_HotelReservation();
        $model->cancelReservation($reservation_id);
        // when session is available
        /*
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead)) {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }
        */
        //$this->redirect("/get-reservations/id/$user_id");
    }


}
































