<?php

class Application_Model_Admin extends Zend_Db_Table_Abstract 
{
protected $_name = 'admin';
function addNewuser($userData)
{
$row = $this->createRow();
$row->username = $userData['name'];

$row->email = $userData['email'];


$row->passwd=$userData['passwd'];

$row->save();
}

function userDetails($userid)
{
return $this->find($userid)->toArray();
}

}

