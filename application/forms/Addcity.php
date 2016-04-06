<?php

class Application_Form_Addcity extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');
     	$this->setAttrib('class','form-horizontal');

     	$id= new Zend_Form_Element_Hidden('id');

     	$name= new Zend_Form_Element_Text('name');
     	$name->setLabel('Name:');
     	$name->setAttribs(array('placeholder'=>'name','class'=>'form-control'));
		$name->setRequired(true);

     	$Longitude= new Zend_Form_Element_Text('Longitude');
     	$Longitude->setLabel('Longitude:');
     	$Longitude->setAttribs(array('placeholder'=>'Longitude','class'=>'form-control'));
		$Longitude->setRequired(true);

     	$latitude= new Zend_Form_Element_Text('latitude');
     	$latitude->setLabel('Latitude:');
     	$latitude->setAttribs(array('placeholder'=>'latitude','class'=>'form-control'));
		$latitude->setRequired(true);

     	$image = new Zend_Form_Element_File('image');
		$image->setLabel('Upload an image:');
		// insure only on file is uploaded
		$image->addValidator('Count', false, 1);
       $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');

     	$rating = new Zend_Form_Element_Text('rating');
     	$rating->setLabel('Rate');
     	$rating->setAttribs(array('placeholder'=>'rate','class'=>'form-control'));
     	$rating->setAttribs(array('type'=>'number','min'=>'1','max'=>'5','step'=>'1'));

     	$description=new Zend_Form_Element_Textarea('description');
     	$description->setLabel('description:');
     	$description->setAttribs(array('placeholder'=>'description','class'=>'form-control','cols'=>'10','rows'=>'8'));

     	$submit= new Zend_Form_Element_Submit('submit');
		$submit->setValue('add');
		$submit->setAttrib('class','btn btn-primary');

		$reset= new Zend_Form_Element_Reset('reset');
        $reset->setValue('reset');
		$reset->setAttrib('class','btn btn-warning');

     	$this->addElements(array($id,$name,$Longitude,$latitude,$image,$rating,$description,$submit,$reset));

    

    }


}

