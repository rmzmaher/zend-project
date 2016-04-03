<?php

class Application_Form_Addcomment extends Zend_Form
{
    /*
     * +---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| content | varchar(200) | NO   |     | NULL    |                |
| post_id | int(11)      | NO   | MUL | NULL    |                |
| user_id | int(11)      | NO   |     | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
     * */
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');


        // client id this is an hidden element
        //  $id = new Zend_Form_Element_Hidden('id');
        //$user_id=1;
        //$city_id=1;

        // content
        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('Your Comment ');
        $content->setAttribs(array(
            'placeholder'=>' your comment here',
            'class'=>'form-control'
        ));
        $content->setRequired();


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
            $content,
            $post,
            $reset
        ));





    }


}

