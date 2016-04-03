<?php

class Application_Form_Addpost extends Zend_Form
{
/*+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| user_id | int(11)      | NO   |     | NULL    |                |
| city_id | int(11)      | NO   |     | NULL    |                |
| title   | varchar(30)  | NO   |     | NULL    |                |
| content | varchar(200) | NO   |     | NULL    |                |
| image   | varchar(100) | NO   |     | NULL    |                |
+---------+--------------+------+-----+---------+----------------+

 * */
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');


        // post id this is an hidden element
        $id = new Zend_Form_Element_Hidden('id');

        // first name <input placeholder form-control>
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title: ');
        $title->setAttribs(array(
            'placeholder'=>'title',
            'class'=>'form-control'
        ));
        $title->setRequired();

        // content
        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('Experience : ');
        $content->setAttribs(array(
            'placeholder'=>' your Experience here',
            'class'=>'form-control'
        ));
        $content->setRequired();

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
            $id,
            $title,
            $content,
            $image,
            $post,
            $reset
        ));





    }


}

