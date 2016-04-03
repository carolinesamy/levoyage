<?php

class Application_Form_Addexperience extends Zend_Form
{

    public function init()
    {
        $photo = new Zend_Form_Element_File('photo');
		$photo->setLabel("Upload Image ")  ; 
		$photo->setAttrib('class', 'form-control ');  
		$photo->setAttrib('id', 'up');          
        $photo->addValidator('Extension', false, 'jpeg,png,gif,jpg');
        $photo->getValidator('Extension')->setMessage('This file type is not supportted.');
        $photo->setDestination('../public/images');
        $photo->setRequired(true);

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('title');
        $title->setAttrib('class','form-control ');
        $title->setRequired();
        $title->addValidator('StringLength', false, Array(5,20));
        $title->addFilter('StringTrim');

        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('content');
        $content->setAttrib('class','form-control ');
        $content->setAttribs(array("cols"=>'3',"rows"=>'3'));
        $content->setRequired();
        $content->addValidator('StringLength', false, Array(5,100));
        $content->addFilter('StringTrim');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add Experience');
        $submit->setAttrib('class','btn btn-info');

       $this->addElements(array($photo,$title,$content,$submit));
    }


}
