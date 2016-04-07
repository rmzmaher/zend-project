<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {

$admin = new Zend_Session_Namespace('admin_Auth');
Zend_Session::namespaceUnset('admin_Auth');
     $authorization = Zend_Auth::getInstance();
            $fbsession = new Zend_Session_Namespace('facebook');
            if (!$authorization->hasIdentity() &&!isset($fbsession->first_name)) {
                if ($this->_request->getActionName() != 'login' &&
                        $this->_request->getActionName() != 'add' && $this->_request->getActionName() != 'fb') {
                        $this->redirect("User/login");
                        }
            }

    }

    public function indexAction()
    {
        // action body
    }

    public function postrAction()
    {
        // action body

        ////////session//////
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $usr=$user->id;
        $name=$user->username;
        ////////posts/////
        $post_obj = new Application_Model_Post();
        // geting city_id
        $city_id= $this->_request->getParam('id');

        $posts = $post_obj->getposts_by_city_id($city_id);
        /////comments///
        $comment_obj=new Application_Model_Comment();
        $comments=$comment_obj->get_comments();
        /// all users ///
        $users= new Application_Model_User();
        $pos_usr=$users->listUsers();

        $this->view->city_id=$city_id;
        $this->view->name=$name;
        $this->view->pos_usr=$pos_usr;
        $this->view->pos = $posts;
        $this->view->com=$comments;
        $this->view->user=$usr;
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
                $load->addFilter('Rename','/var/www/html/zend_pro/public/images/post/'.$_POST['title'].'.jpg');
                $load->receive();
                //this is to link with city page and userid[session]
                //////////////
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $user=$storage->read();
                $_POST['user_id']=$user->id;
                /////////////
                // geting city_id
                $city_id= $this->_request->getParam('id');

                $_POST['city_id']=$city_id;
                $_POST['image']='/images/post/'.$_POST['title'].'.jpg';
                $post_obj->create_post($_POST);
                $this->redirect('/user/postr/id/'.$city_id.'');
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
                //////////////
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $user=$storage->read();
                $_POST['user_id']=$user->id;
                /////////////;
                // geting city_id
                $city_id= $this->_request->getParam('cityid');
                $_POST['city_id']=$city_id;
               // var_dump( $_POST);die();
                $post_obj->update_post($_POST);
                $this->redirect('/user/postr/id/'.$city_id.'');
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
        // geting city_id
        $city_id= $this->_request->getParam('cid');

        $this->redirect('/user/postr/id/'.$city_id.'');

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
        $this->redirect('/user/postr/');
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
               echo $com_obj->create_comment($req->getParams());
            }
        //$comment_id.;;
    }

    public function mapAction()
    {
        // action body
        // geting city_id
        $city_id= $this->_request->getParam('id');
        /////
        $city_obj = new Application_Model_City();
     //from main city page  //$id=$this->_request->getParam('id');
        $city=$city_obj->one_city($city_id);
        $this->view->city = $city;
    }

    public function showlocationsAction()
    {
        // action body
        $location_obj=new Application_Model_Location();
        // geting city_id
        $city_id= $this->_request->getParam('id');

        $locations = $location_obj->getlocations_by_city_id($city_id);
        $paginator = Zend_Paginator::factory($locations);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/user/pagination.phtml');
       // var_dump($paginator);die();
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(2);
        //var_dump($paginator);
        $this->view->paginator = $paginator;

    }
/// list users won't be here in admin panel
    public function listAction()
    {
         $user_model = new Application_Model_User();
       $this->view->users = $user_model->listUsers();
    }

    /// signup action
    public function addAction()
    {
        //$this->_helper->layout()->disableLayout(); 
            //$this->_helper->viewRenderer->setNoRender(true);
            $form = new Application_Form_Adduser();
            $request = $this->getRequest();
         //   $para=$request->getParams();
            //var_dump($para);

            if($request->isPost()){
                    if($form->isValid($request->getPost())){
                            $user_model = new Application_Model_User();
                            $user_model-> addNewuser($request->getParams());
                            $this->redirect('/user/login');
                            }
            }

            $this->view->user_form = $form; 
    }

// update user data
    public function editAction()
    {
            $form = new Application_Form_Edit ();
            $user_model = new Application_Model_User ();
            $id = $this->_request->getParam('uid');
            $user_data = $user_model-> userDetails ($id)[0];


            $form->populate($user_data);
            $this->view->user_form = $form;


            $request = $this->getRequest ();
            if($request-> isPost()){
            if($form-> isValid($request-> getPost())){

            $user_model-> updateuser ($id, $_POST);

            $this->redirect('/user/list ');
            }

            }
    }

    /// details of user
    public function detailsAction()
    {
        $user_model = new Application_Model_User();
        $us_id = $this->_request->getParam("uid");
        $user = $user_model->userDetails($us_id);

        $this->view->user = $user;

    }

    public function deleteAction()
    {

        $user_model = new Application_Model_User();
        $us_id = $this->_request->getParam("uid");
        $user = $user_model->userDetails($us_id);
        $user_model->deleteUser($us_id);

        $this->redirect("/user/list");
    }

///country main page
    public function listcountryAction()
    {
        $country_obj= new Application_Model_Country();
        $country_id=$this->_request->getParam("id");
        $one_country=$country_obj->one_country($country_id);

         $this->view->country = $one_country;

        $posts_of_user_id =$country_obj->find_all_country_city($country_id);
        $this->view->cities = $posts_of_user_id;
        
        // $all_city= $city_obj->all_city($country_id);
        // $this->view->country = $one_country;
        // $this->view->cities = $all_city;
    }

    public function listcityAction()
    {
        $city_obj= new Application_Model_City();
        $country_obj= new Application_Model_Country();
        $country_id= $this->_request->getParam("id");
        $posts_of_user_id =$country_obj->find_all_country_city($country_id);
        $this->view->cities = $posts_of_user_id;
    }

//city main page

    public function citydataAction()
    {
        // user
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;
        $this->view->user=$user_id;
        //
        $city_obj= new Application_Model_City();
        $city_id= $this->_request->getParam("id");
        $one_city= $city_obj->one_city($city_id);
        $this->view->city = $one_city;


    }


    public function homeAction()
    {
        $country_obj= new Application_Model_Country();
        $city_obj= new Application_Model_City();
        $all_country= $country_obj->all_country();
        $this->view->countries = $all_country;

        $all_city= $city_obj->listcity();
        $this->view->cities = $all_city;
    }


    public function makeReservationAction()
    {
        /// user
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;
        $id=$this->_request->getParam('cid');
        ///reservation form
        $HreservForm=new Application_Form_HotelReservation();
        $HreservForm->setId($id);
        $HreservForm->setHotels();
        ////
        $this->view->hotelreservform=$HreservForm;
        //$user_id= $this->_request->getParam("id");

        /////////////////////
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
                $this->redirect("/user/get-reservations");

            }
        }
    }

//// hotel reserve
    public function getReservationsAction()
    {
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;
        //$user_id= $this->_request->getParam("id");
        $model=new Application_Model_HotelReservation();

        $reservs=$model->getUserReservation($user_id);
        $this->view->reservers=$reservs;
    }
/// make reservation
    public function makeCarReservAction()
    {
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;

        $CreservForm= new Application_Form_CarReservation();
        $this->view->carform=$CreservForm;

        $request=$this->getRequest();
        $carReservModel= new Application_Model_CarReservation();
        //$user_id= $this->_request->getParam("id");
        if($request->isPost()){
            if($CreservForm->isValid($request->getPost())) {
                $data['from'] = $_POST['from'];
                $data['to'] = $_POST['to'];
                $data['location'] = $_POST['location'];
                $data['user_id'] = $user_id;
                $carReservModel->reserveCar($data);
                $this->redirect("/user/get-car-reservation");
            }
        }
    }
// get car reservation
    public function getCarReservationAction()
    {
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;

        //$user_id= $this->_request->getParam("id");
        $carReservModel= new Application_Model_CarReservation();
        $rents=$carReservModel->getUserReservation($user_id);
        $this->view->rents=$rents;
    }
/// update rent
    public function updateRentAction()
    {
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $user=$storage->read();
        $user_id=$user->id;

        $rent_id= $this->_request->getParam("id");
        $form=new Application_Form_UpdateRent();
        $model= new Application_Model_CarReservation();
        $rent=$model->getOneRent($rent_id);
        //$user_id=$rent[0]['user_id'];
        $form->populate($rent[0]);
        $this->view->Form=$form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $model->updateRent($_POST,$rent_id);
                $this->redirect('/user/get-car-reservation');
            }
        }
    }
//delete rent
    public function deleterentAction()
    {

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead)) {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }

        $rent_id= $this->_request->getParam("id");
        $model = new Application_Model_CarReservation();
        $model->cancelReservation($rent_id);
        $this->redirect('/visit/get-car-reservation');
    }
/// update reservation
    public function updateReservationAction()
    {
        $reservation_id= $this->_request->getParam("id");
        $form= new Application_Form_UpdateRservation();

        $model= new Application_Model_HotelReservation();
        $reservation = $model->getOneReservation($reservation_id);
        $form->populate($reservation);
        $this->view->form=$form;


        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead))
        {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }


        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $data['name']=$_POST['name'];
                $data['from']=$_POST['from'];
                $data['to']=$_POST['to'];
                $data['member']=$_POST['member'];

                $data['user_id']=$user_id;
                $model->editReservation($data,$reservation_id);
                $this->redirect("/get-reservations");
            }
        }
    }
//delete reservation
    public function deletereservationAction()
    {
        $reservation_id= $this->_request->getParam("id");
        $model= new Application_Model_HotelReservation();
        $model->cancelReservation($reservation_id);

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        if (!empty($sessionRead)) {
            $user_name = $sessionRead->user_name;
            $user_id=$sessionRead->user_id;
        }

        $this->redirect("/get-reservations");
    }


    // public function blockAction()
    // {
    //     $user_model = new Application_Model_User();
    //     $us_id = $this->_request->getParam("uid");
    //     $user = $user_model->blockUser($us_id);
    //     $this->redirect("/user/list");
    // }

/// login function
    public function loginAction()
    {
        
    $login_form = new Application_Form_Login( );
            $this->view->form=$login_form;

            if ($this->_request->isPost()) {
            if ($login_form->isValid($this->_request->getPost( ))) {

                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('passwd');

                //echo $password;
                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter( );
                //create the auth adapter
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', "email",
                'passwd');
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                //authenticate
                $result = $authAdapter->authenticate( );


            if ($result->isValid( )) {


                $auth = Zend_Auth::getInstance( );
                //if the user is valid register his info in session
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                // write in session email & id & first_name
                $storage->write($authAdapter->getResultRowObject(array('email', 'id',
                'username')));
                // redirect to root index/index
                return $this->redirect( '/user/home');
            }
            else
            {

              
                $message="invalid email or passsword";
                $this->view->mes=$message;
                 

            }
            }


    }

    $fb = new Facebook\Facebook([
            'app_id' => '1053124444745810', // Replace {app-id} with your app id
            'app_secret' => 'f59c1160c1b299e2201e223fd09cdb85',
            'default_graph_version' => 'v2.2',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .
            $this->view->baseUrl() . '/user/fb');
            $this->view->facebook_url = $loginUrl;
    }

    public function fbAction()
    {
        $fb = new Facebook\Facebook([
            'app_id' => '1053124444745810', // Replace {app-id} with your app id
            'app_secret' => 'f59c1160c1b299e2201e223fd09cdb85',
            'default_graph_version' => 'v2.2',
            ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
        $accessToken = $helper->getAccessToken();
        }
        catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error (headers link)
        echo 'Graph returned an error: ' . $e->getMessage();
        Exit;
        }
        catch (Facebook\Exceptions\FacebookSDKException $e) {
         //When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        Exit;
        }
#####################################################################
if (!isset($accessToken)) {
if ($helper->getError()) {
header('HTTP/1.0 401 Unauthorized');
echo "Error: " . $helper->getError() . "\n";
echo "Error Code: " . $helper->getErrorCode() . "\n";
echo "Error Reason: " . $helper->getErrorReason() . "\n";
echo "Error Description: " . $helper->getErrorDescription() .
"\n";
}
else {
header('HTTP/1.0 400 Bad Request');
echo 'Bad request';
}
Exit;
}

#####################################################
$oAuth2Client = $fb-> getOAuth2Client ();
//check if access token expired
if (!$accessToken-> isLongLived ()) {
// Exchanges a short-lived access token for a long-lived one
try {
/// try to get another access token
$accessToken = $oAuth2Client-> getLongLivedAccessToken ($accessToken);
}
catch (Facebook\Exceptions\FacebookSDKException $e) {
echo "<p>Error getting long-lived access token: " . $helper->getMessage () . "</p>\n\n";
Exit;
}
}

#####################################################
//Sets the default fallback access token so we don't have to pass it to each request
$fb->setDefaultAccessToken($accessToken);
try {
$response = $fb->get('/me');
$userNode = $response->getGraphUser();
}
catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
Exit;
}
catch (Facebook\Exceptions\FacebookSDKException $e) {
 //When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
Exit;
}
$fpsession = new Zend_Session_Namespace('facebook');
// write in session email & id & first_name
$fpsession->first_name= $userNode->getName();

$this->redirect('/user/list');


    }

    public function logoutAction()
    {
        

Zend_Auth::getInstance()->clearIdentity();
        $this->redirect('/user/login');


    }

    public function fblogoutAction()
    {

 Zend_Session::namespaceUnset('facebook');
        $this->redirect("/user/login");

    }


}










































