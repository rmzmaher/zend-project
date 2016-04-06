<?php

class Application_Form_Newhotel extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('POST');
        $this->setAttrib('class','form_horizontal container');
        $this->setAttrib('id','new');
        $id =new Zend_Form_Element_Hidden('id');

        $name= new Zend_Form_Element_Text('name');
        $name->setLabel('Hotel Name :');
        $name->setAttribs(array(
            'placeholder'=>'Enter Hotel name',
            'class'=>'form-control'
        ));
        $name->isRequired();

        $address= new Zend_Form_Element_Text('address');
        $address->setLabel('Hotel Address :');
        $address->setAttribs(array(
            'placeholder'=>'Enter Hotel Address',
            'class'=>'form-control'
        ));

        $phone= new Zend_Form_Element_Text('phone');
        $phone->setLabel('Hotel Phone :');
        $phone->setAttribs(array(
            'placeholder'=>'Enter Hotel phone',
            'class'=>'form-control'
        ));

        $email= new Zend_Form_Element_Text('email');
        $email->setLabel('Hotel Email :');
        $email->setAttribs(array(
            'placeholder'=>'Enter Hotel email',
            'class'=>'form-control'
        ));
        $email->addValidator('EmailAddress',TRUE); //validation on email shape
        //$email->addValidator('db_NoRecordExists',TRUE,array('clients','email'));// to check that the email doesn't exist


        $rate= new Zend_Form_Element_Text('rate');
        $rate->setLabel('Hotel Rate :');
        $rate->setAttribs(array(
            'placeholder'=>'Enter Hotel rate',
            'class'=>'form-control'
        ));
        /******************** change when city model is here *****************************/
        /*
        $city = new Zend_Form_Element_Select('city');
        $city->setAttrib('class' ,'form-control');
        $city_obj= new Application_Model_City();
        $all_cities =$city_obj->listAll();
        foreach ($all_cities as $key=>$value)
        {
            $city->addMultiOption($value['t_id'],$value['t_name']);
        }
        $city->setLabel('City :');*/

        $city= new Zend_Form_Element_Text('city_id');
        $city->setLabel('City :');
        $city->setAttribs(array(
            'placeholder'=>'Enter City name',
            'class'=>'form-control',

        ));

        //submit button
        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setValue('save');
        $submit->setAttrib('class','btn btn-success');

        $this->addElements(array(
            $id,
            $name,
            $address,
            $phone,
            $email,
            $rate,
            $city,
            $submit
        ));
    }
}

