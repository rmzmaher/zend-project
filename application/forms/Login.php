<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
       $this->setMethod('POST');
        $pswd = new Zend_Form_Element_Password('password');
        $pswd->setLabel('enter Password:');
        $pswd->setAttrib('size', 35);
        $pswd->setRequired(true);
        $pswd->setAttribs(Array(
            'class'=>'form-control'
        ));


        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('email: ');
        $email->setAttribs(Array(
        'class'=>'form-control ',
        ));
        $email->setRequired();

        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(Array(
                    'class'=>'btn btn-default '
                ));
        $submit->setvalue('save');

        $this->addElements(array(
            $email,
            $pswd,
            $submit
        ));


    }


}

