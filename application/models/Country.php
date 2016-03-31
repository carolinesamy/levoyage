<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name="country";
    //to add parent --dependent tables on it
    protected $_dependentTables=array('Application_Model_City');


}

