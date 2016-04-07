<?php

class Application_Form_Addexperience extends Zend_Form
{

    public function init()
    {

        $photo = new Zend_Form_Element_File('photo');
		$photo->setLabel("Click to Add Image ")  ; 
		$photo->setAttrib('class', 'form-control ');  
		$photo->setAttrib('id', 'selectedFile');          
        $photo->addValidator('Extension', false, 'jpeg,png,gif,jpg');
        $photo->getValidator('Extension')->setMessage('This file type is not supportted.');
        $photo->setDestination('../public/images');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel(' title');
        $title->setAttrib('class','form-control ');
        $title->setRequired();
        $title->addValidator('StringLength', false, Array(5,20));
        $title->addFilter('StringTrim');
        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('content');
        $content->setAttrib('class','form-control ');
        $content->setAttribs(array("cols"=>'4',"rows"=>'6'));
        $content->setRequired();
        $content->addValidator('StringLength', false, Array(5,1000));
        $content->addFilter('StringTrim');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add Experience');
        $submit->setAttrib('class','btn btn-link-2 btn-block');

       $this->addElements(array($photo,$title,$content,$submit));
    }


}

