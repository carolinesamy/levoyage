<?php

class Application_Form_Hotel extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');
        $members = new Zend_Form_Element_Text('members');
        $members->setLabel('Number of members');
        $members->setAttrib('class','form-control hotel_members');

        $members->addValidator('int', false);
        $members->setRequired();

        $from = new Zend_Form_Element_Text('from');
        $from->setLabel('From Date');
        $from->setAttrib('class','form-control hotel_from date_field');
        $from->addValidator('Date', false);
        $from->setRequired();
        $from->setAttrib('readonly','readonly');


        $to = new Zend_Form_Element_Text('to');
        $to->setLabel('To Date');
        $to->setAttrib('class','form-control hotel_to date_field');
        $to->setAttrib('data-format','"dd/MM/yyyy hh:mm:ss"');
        $to->addValidator('Date', false);
        $to->setAttrib('readonly','readonly');
        $to->setRequired();
        $reset=new Zend_Form_Element_Reset('reset');
        $reset->setAttrib('class','btn btn-danger');
        $this->addElements(array($members,$from,$to,$reset));

    }


}

