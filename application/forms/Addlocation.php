<?php

class Application_Form_Addlocation extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('POST'); //ay 7aga gwa tag el form yt7at gwa this
        $this->setAttrib('class','form-horizontal'); //law el attribute dah pya5od aktr mn 7aga hakrr el line dah marteen
        $this->setAttrib('id','edit');

        $id=new Zend_Form_Element_Hidden('id');


        $name= new Zend_Form_Element_Text('name');
        $name->setLabel('Location Name');
        $name->setAttribs(array('class'=>'form-control'));
        $name->setRequired();

        $description= new Zend_Dojo_Form_Element_Textarea('description');
        $description->setLabel('Description');
        $description->setAttribs(array('class'=>'form-control'));


        $image_path= new Zend_Form_Element_File('image_path');
        $image_path->setLabel('choose Image');
        $image_path->addValidator('Count',false,1);
        $image_path->addValidator('Extension',false,'jpg,jpeg,png,gif');


        $city=new Zend_Form_Element_Select('city_id');
        $city->setLabel('City name');
        $city->setAttribs(array('class'=>'form-control'));
        $c=new Application_Model_City();
        $allcities=$c->allcity();
        foreach($allcities as $key=> $value)
        {
            $city->addMultiOption($value['id'], $value['name']);

        }
        $city->setRequired();


        $add =new Zend_Form_Element_Submit('add');
        $add->setValue('Save');
        $add->setAttribs(array('class'=>'btn btn-success form-vertical'));


        $this->addElements(array($id,$name ,$city,$description,$image_path,$add));
    }


}

