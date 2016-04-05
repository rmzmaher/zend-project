<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        



$authorization = Zend_Auth::getInstance();
$fbsession = new Zend_Session_Namespace('admin_Auth');
if (!$authorization->hasIdentity() &&
!isset($fbsession->first_name)) {
if ($this->_request->getActionName() != 'login' ) {
$this->redirect("User/login");
}
}





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
                $load = new Zend_File_Transfer_Adapter_Http();
                $load->addFilter('Rename', '/var/www/html/zend_pro/public/images/location/' . $_POST['name'] . '.jpg');
                $load->receive();
                $_POST['city_id'] = 1;
                $_POST['image'] = '/images/location/' . $_POST['name'] . '.jpg';
                $post_obj->add_location($_POST);
                $this->redirect('/admin/show');
            }
        }
        $this->view->myform = $form;
    }

    public function allcountryAction()
    {
        $country_obj = new Application_Model_Country();
        $all_country = $country_obj->all_country();
        $this->view->countries = $all_country;
    }

    public function onecountryAction()
    {
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $one_country = $country_obj->one_country($country_id);
        $this->view->country = $one_country;
    }

    public function removecountryAction()
    {
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $delete_country = $country_obj->remove_country($country_id);
        $this->redirect("/admin/allcountry");
    }

    public function addcountryAction()
    {
        $form = new Application_Form_Add();
        $country_obj = new Application_Model_Country();
        $this->view->add_form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $load = new Zend_File_Transfer_Adapter_Http();
                //$image=$_FILES['image']['name'];
                $load->addFilter('Rename', '/var/www/html/visit/public/images/country/' . $_POST['name'] . '.jpg');
                $load->receive();
                $_POST['image'] = '/images/country/' . $_POST['name'] . '.jpg';
                $country_obj->add_country($_POST);
                $this->redirect("/admin/allcountry");
            }
        }
    }

    public function editcountryAction()
    {
        $form = new Application_Form_Add();
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $editcountry = $country_obj->one_country($country_id);
        $form->populate($editcountry[0]);
        $this->view->editform = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $country_obj->edit_country($country_id, $_POST);
                $this->redirect("/admin/allcountry");
            }
        }
    }

    public function allcityAction()
    {
        $city_obj = new Application_Model_City();
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
//$city=$city_obj->get_city_obj_by_country_id(1);
        $posts_of_user_id = $country_obj->find_all_country_city($country_id);


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
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
        $one_city = $city_obj->one_city($city_id);
        $this->view->city = $one_city;
    }

    public function removecityAction()
    {
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
        $one_city = $city_obj->remove_city($city_id);
        $this->redirect("/admin/allcity");
    }

    public function editcityAction()
    {
        $form = new Application_Form_Addcity();
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
        $editcity = $city_obj->one_city($city_id);
        $form->populate($editcity[0]);
        $this->view->editform = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $city_obj->edit_city($city_id, $_POST);
                $this->redirect("/admin/allcity");
            }
        }
    }

    public function addcityAction()
    {
        $form = new Application_Form_Addcity();
        $city_obj = new Application_Model_City();
        $country_id = $this->_request->getParam("id");
        $this->view->add_form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $load = new Zend_File_Transfer_Adapter_Http();
                //$image=$_FILES['image']['name'];
                $load->addFilter('Rename', '/var/www/html/visit/public/images/city/' . $_POST['name'] . '.jpg');
                $load->receive();
                $_POST['image'] = '/images/city/' . $_POST['name'] . '.jpg';
                $_POST['country_id'] = $country_id;
                $city_obj->add_city($_POST);
                $this->redirect("/admin/allcity");
            }
        }

    }

    public function loginAction()
    {
        
$login_form = new Application_Form_Admin( );
$this->view->form=$login_form;

if ($this->_request->isPost()) {
if ($login_form->isValid($this->_request->getPost( ))) {

$email = $this->_request->getParam('email');
$password = $this->_request->getParam('passwd');
//echo $email;
//echo $password;
// get the default db adapter
$db = Zend_Db_Table::getDefaultAdapter( );
//create the auth adapter
$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'admin', "email",
'passwd');
$authAdapter->setIdentity($email);
$authAdapter->setCredential($password);
//authenticate
$result = $authAdapter->authenticate( );

//var_dump($result);
if ($result->isValid( )) {

$adminsession = new Zend_Session_Namespace('admin_Auth');
/*
$auth = admin_Auth::getInstance( );
//if the user is valid register his info in session

$storage = $auth->getStorage();
// write in session email & id & first_name
$storage->write($authAdapter->getResultRowObject(array('email', 'id',
'name')));

*/

$adminsession->first_name =$authAdapter->getResultRowObject(array('email', 'id',
'name')); 

// redirect to root index/index
return $this->redirect( '/admin/list');


}

else
{
$message="invalid email or password ";
$this->view->mes=$message;


}




}







    }





    }

    public function listAction()
    {
       
        $user_model = new Application_Model_User();
        $this->view->user=$user_model->listUsers();



    }

    public function logoutAction()
    {
        

Zend_Session::namespaceUnset('admin_Auth');
$this->redirect("/user/login");







    }

    public function blockAction()
    {
        
	$user_model = new Application_Model_User();
	$us_id = $this->_request->getParam("uid");
	$user = $user_model->blockUser($us_id);
	$this->redirect("/admin/list");
                  




    }


}









