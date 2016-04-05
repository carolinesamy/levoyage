<?php

class Application_Form_Addcity extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('POST'); //ay 7aga gwa tag el form yt7at gwa this
        $this->setAttrib('class','form-horizontal'); //law el attribute dah pya5od aktr mn 7aga hakrr el line dah marteen
        $this->setAttrib('id','edit');

        $id=new Zend_Form_Element_Hidden('id');


        $name= new Zend_Form_Element_Text('name');
        $name->setLabel('City Name');
        $name->setAttribs(array('class'=>'form-control'));

        $description= new Zend_Dojo_Form_Element_Textarea('description');
        $description->setLabel('Description');
        $description->setAttribs(array('class'=>'form-control'));


        $image_path= new Zend_Form_Element_File('image_path');
        $image_path->setLabel('choose Image');
        $image_path->addValidator('Count',false,1);
        $image_path->addValidator('Extension',false,'jpg,jpeg,png,gif');


        $country=new Zend_Form_Element_Select('country_id');
        $country->setLabel('Country name');
        $country->setAttribs(array('class'=>'form-control'));
        $c=new Application_Model_Country();
        $allcities=$c->allcountry();
        foreach($allcities as $key=> $value)
        {
            $country->addMultiOption($value['id'], $value['name']);

        }
        $country->setRequired();







        $add =new Zend_Form_Element_Submit('add');
        $add->setValue('Save');
        $add->setAttribs(array('class'=>'btn btn-success form-vertical'));





        $this->addElements(array($id,$name ,$country,$description,$image_path,$add));
    }


}

