<?php

class Application_Form_Addcounrty extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */


        $this->setMethod('POST'); //ay 7aga gwa tag el form yt7at gwa this
        $this->setAttrib('class','form-horizontal'); //law el attribute dah pya5od aktr mn 7aga hakrr el line dah marteen
        $this->setAttrib('id','edit');

        $id=new Zend_Form_Element_Hidden('id');


        $name= new Zend_Form_Element_Text('name');
        $name->setLabel('Country Name');
        $name->setAttribs(array('class'=>'form-control'));
        $name->setRequired();

        $image_path= new Zend_Form_Element_File('image_path');
        $image_path->setLabel('choose Image');
        $image_path->addValidator('Count',false,1);
        $image_path->addValidator('Extension',false,'jpg,jpeg,png,gif');



        $lat=new Zend_Form_Element_Text('lat');
        $lat->setLabel('Latitude');
        $lat->setAttribs(array('class'=>'form-control'));
        // $lat->addValidator('');

        $longd=new Zend_Form_Element_Text('longd');
        $longd->setLabel('Longitude');
        $longd->setAttribs(array('class'=>'form-control'));

        $add =new Zend_Form_Element_Submit('add');
        $add->setValue('Save');
        $add->setAttribs(array('class'=>'btn btn-success form-vertical'));



        $this->addElements(array($id,$name ,$image_path,$lat,$longd ,$add));

    }


}

