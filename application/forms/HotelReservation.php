<?php

class Application_Form_HotelReservation extends Zend_Form
{
    public $_id = 0;

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('POST');
        $this->setAttrib('class','form_horizontal container');
        $this->setAttrib('id','newHReserv');

       // $id =new Zend_Form_Element_Hidden('id');

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

        $member= new Zend_Form_Element_Text('member');
        $member->setLabel('Number of members :');
        $member->setAttribs(array(
            'placeholder'=>' number of members',
            'class'=>'form-control'
        ));
        //submit button
        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setValue('Reserve');
        $submit->setAttrib('class','btn btn-success');

        $this->addElements(array(
            $from,
            $to,
            $member,
            $submit
        ));

    }

    public function setId($id){
        $this->_id = $id;
        }

    public function setHotels(){
        $name = new Zend_Form_Element_Select('name');
        $name->setAttrib('class' ,'form-control');
        $hotel_model=new Application_Model_Hotel();
        $city_id=$this->_id;
        $hotels=$hotel_model->get_hotels_by_city_id($city_id);

        foreach ($hotels as $key=>$value)
        {
            $name->addMultiOption($value['id'],$value['name']);
        }
        $name->setLabel("Hotel Name:");

        $this->addElement($name);
    }
}

