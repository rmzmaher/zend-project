<?php

class Application_Form_CarReservation extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');
        $this->setAttrib('class','form_horizontal container');
        $this->setAttrib('id','newCReserv');

        $id =new Zend_Form_Element_Hidden('id');

        $location= new Zend_Form_Element_Text('location');
        $location->setLabel('Location :');
        $location->setAttribs(array(
            'placeholder'=>' Location',
            'class'=>'form-control'
        ));

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

        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setValue('Reserve');
        $submit->setAttrib('class','btn btn-success');

        $this->addElements(array(
            $id,
            $location,
            $from,
            $to,
            $submit
        ));
    }


}

