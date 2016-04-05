<?php

class Application_Model_User  extends Zend_Db_Table_Abstract 
{

protected $_name = 'user';
function addNewuser($userData)
{
$row = $this->createRow();
$row->username = $userData['username'];

$row->email = $userData['email'];
$row->gender = $userData['gender'];

$row->passwd=$userData['passwd'];

$row->save();
}


function listUsers()
{
return $this-> fetchAll() ->toArray();
}

function userDetails($userid)
{
return $this->find($userid)->toArray();
}


function updateuser($userid,$userData)
{

$userdata['username']=$userData['username'];

$userdata['gender']=$userData['gender'];
$userdata['email']=$userData['email'];

$userdata['passwd']=$userData['passwd'];
$this->update($userdata,"id=$userid");


}



function deleteuser($userid)
{


$this->delete("id=$userid");


}









function blockUser($userid)
{
$userdata['active']=0;
$this->update($userdata,"id=$userid");
}


/*
function isactive($userid)
{

return $this->find($userid)->toArray();

}
*/

}

