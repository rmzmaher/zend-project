<?php

class Application_Form_Addlocation extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');

        // first name <input placeholder form-control>
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('NAME : ');
        $name->setAttribs(array(
            'placeholder'=>'title',
            'class'=>'form-control'
        ));
        $name->setRequired();

        // content
        $describtion = new Zend_Form_Element_Textarea('describtion');
        $describtion->setLabel('describtion : ');
        $describtion->setAttribs(array(
            'placeholder'=>' your location description',
            'class'=>'form-control'
        ));
        $describtion->setRequired();

        // image
        $image= new Zend_Form_Element_File('image');
        $image->setLabel('Add Image');
        $image->addValidator('count',false,1);
        $image->addValidator('Extension',false,'jpg,png');


        // submit
        $post = new Zend_Form_Element_Submit('submit');
        $post->setValue('Save');
        $post->setAttrib('class', 'btn btn-success');

        //reset
        $reset = new Zend_Form_Element_Reset('reset');
        $reset->setValue('Reset');
        $reset->setAttrib('class', 'btn btn-danger');



        // Add Element to my form
        $this->addElements(array(
            $name,
            $describtion,
            $image,
            $post,
            $reset
        ));





    }


}

