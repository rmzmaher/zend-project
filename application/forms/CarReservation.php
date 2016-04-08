<?php

class Application_Form_CarReservation extends Zend_Form
{
    static $city_id;

    public function init()
    {
        $this->setMethod('POST');
        $this->setAttrib('class','form_horizontal container');
        $this->setAttrib('id','newCReserv');

        $id =new Zend_Form_Element_Hidden('id');

        $location = new Zend_Form_Element_Select('location');
        $location->setAttrib('class' ,'form-control');
        $location_obj= new Application_Model_Location();
        //$location_obj=new Application_mode
        $all_locations =$location_obj->getlocations_by_city_id(self::$city_id);
        foreach ($all_locations as $key=>$value)
        {
            $location->addMultiOption($value['id'],$value['name']);
        }
        $location->setLabel('Location :');

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

