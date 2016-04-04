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
     ///using form
        /*   // action body
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
*/
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $req=$this->getRequest();
        if($req->isPost()){
            $com_obj=new Application_Model_Comment();
            $com_obj->create_comment($req->getParams());
            }
    }

    public function mapAction()
    {
        // action body
        $city_obj = new Application_Model_City();
     //from main city page  //$id=$this->_request->getParam('id');
        $city=$city_obj->one_city(1);
        $this->view->city = $city;

    }

    public function showlocationsAction()
    {
        // action body
        $location_obj=new Application_Model_Location();
        $locations = $location_obj->getlocations_by_city_id(1);
        $paginator = Zend_Paginator::factory($locations);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/user/pagination.phtml');
       // var_dump($paginator);die();
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(2);
        //var_dump($paginator);
        $this->view->paginator = $paginator;

    }


}