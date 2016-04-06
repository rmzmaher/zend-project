<?php

class Application_Form_Adduser extends Zend_Form
{

    public function init()
    {
        


$this->setMethod('POST');
$id = new Zend_Form_Element_Hidden('id');
$active = new Zend_Form_Element_Hidden('active');
$fname = new Zend_Form_Element_Text('username');
$fname->setLabel('First Name: ');
$fname->setAttribs(Array(
'placeholder'=>'Example: ghada',
'class'=>'form-control'
));
$fname->setRequired();
//$fname->addValidator('StringLength', false, Array(4,20));







$email = new Zend_Form_Element_Text('email');
$email->setLabel('email: ');
$email->setAttribs(Array(
'class'=>'form-control'
));
$email->setRequired();

$email->addValidator( 'Db_NoRecordExists', true, array(  'name'    => 'EmailAddress','table' => 'user', 'field' => 'email', 'messages' => array( 'recordFound' => 'Email already taken' )));

$validator=new Zend_Validate_EmailAddress();
$email->addValidator('EmailAddress',true);



/*
if($validator->isValid($email)){}
else{
print_r($validator->getMessages());
}
*/

$pswd = new Zend_Form_Element_Password('passwd');
$pswd->setLabel('New Password:');
$pswd->setAttrib('size', 35);
$pswd->setRequired(true);


$pswd->addValidator('StringLength', false, array(4,15));
$pswd->addErrorMessage('Please choose a password between 4-15 characters');

$confirmPswd = new Zend_Form_Element_Password('confirm_pswd');
$confirmPswd->setLabel('Confirm New Password:');
$confirmPswd->setAttrib('size', 35);
$confirmPswd->setRequired(true);
$confirmPswd->addValidator('Identical', false, array('token' => 'passwd'));
$confirmPswd->addErrorMessage('The passwords do not match');





$gender = new Zend_Form_Element_Select('gender');
$gender->setRequired();
$gender->setLabel('gender');
$gender->addMultiOption('male','Male')->
addMultiOption('female','Female')->
addMultiOption('non','Prefer not to mention');
$gender->setAttrib('class', 'form-control');


$submit=new Zend_Form_Element_Submit('submit');
$submit->setvalue('save');

$this->addElements(array($id,$fname,$email,$gender,$pswd,$confirmPswd,$submit,$active));


















    }


}

