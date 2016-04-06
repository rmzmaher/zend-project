<?php

class Application_Form_UpdateRservation extends Zend_Form
{

    public function init()
    {

        $this->setMethod('POST');
        $this->setAttrib('class','form_horizontal container');
        $this->setAttrib('id','updateReserv');

        $id =new Zend_Form_Element_Hidden('id');
        $user_id =new Zend_Form_Element_Hidden('user_id');

        $name = new Zend_Form_Element_Select('name');
        $name->setAttrib('class' ,'form-control');
        $hotel_model=new Application_Model_Hotel();
        $hotels=$hotel_model->listAllHotels();
        foreach ($hotels as $key=>$value)
        {
            $name->addMultiOption($value['id'],$value['name']);
        }
        $name->setLabel("Hotel Name:");

        $from= new Zend_Form_Element_Text('from');
        $from->setLabel('From :');
        $from->setAttribs(array(
            'placeholder'=>'From',
            'class'=>'form-control',
            'id'=>'from_field',
            'readonly'=>1
        ));

        $to= new Zend_Form_Element_Text('to');
        $to->setLabel('To :');
        $to->setAttribs(array(
            'placeholder'=>'To',
            'class'=>'form-control',
            'id'=>'to_field',
            'readonly'=>1
        ));

        $members= new Zend_Form_Element_Text('member');
        $members->setLabel('Number of members :');
        $members->setAttribs(array(
            'placeholder'=>' number of members',
            'class'=>'form-control'
        ));
        //submit button
        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setValue('Reserve');
        $submit->setAttrib('class','btn btn-success');

        $reset= new Zend_Form_Element_Reset('reset');
        $reset->setValue('update');
        $reset->setAttrib('class','btn btn-warning');

        $this->addElements(array(
            $id,
            $user_id,
            $name,
            $from,
            $to,
            $members,
            $submit,
            $reset
        ));
    }


}

