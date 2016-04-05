<?php

class Application_Form_Add extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');
     	$this->setAttrib('class','form-horizontal');
     	$id= new Zend_Form_Element_Hidden('id');
     	$name= new Zend_Form_Element_Text('name');
     	$name->setLabel('Name:');
     	//$image= new Zend_Form_Element_Text('image');
     	//$image->setLabel('Image');
     	$image = new Zend_Form_Element_File('image');
      	
	$image->setLabel('Upload an image:');
       
	// changing the name of uploaded image
	//$image->addFilter('Rename','/var/www/html/visit/public/images/NAME.jpg');
	
	// insure only on file is uploaded	
	$image->addValidator('Count', false, 1);
  
       $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');
       
	//receving the uploaded file
	//$image->receive();

     	$rating = new Zend_Form_Element_Text('rating');
     	$rating->setLabel('Rate');
     	$rating->setAttribs(array('min'=>'1','max'=>'5','step'=>'1'));
     	$description=new Zend_Form_Element_Textarea('description');
     	$description->setLabel('description:');
     	$submit= new Zend_Form_Element_Submit('submit');
         $submit->setValue('add');
         $submit->setAttrib('class','btn btn-primary');
     	$this->addElements(array($id,$name,$image,$rating,$description,$submit));
    }


}

