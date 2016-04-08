<?php

class Application_Form_Addhotel extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST'); //ay 7aga gwa tag el form yt7at gwa this
        $this->setAttrib('class','form-horizontal'); //law el attribute dah pya5od aktr mn 7aga hakrr el line dah marteen
        $this->setAttrib('id','hotel');

        //$id=new Zend_Form_Element_Hidden('id');


        $name= new Zend_Form_Element_Text('name');
        $name->setLabel('Hotel Name');
        $name->setAttribs(array('class'=>'form-control'));

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
        $this->addElements(array($name,$city,$add));

    }


}

