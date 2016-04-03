<?php

class Application_Model_Bookhotel extends Zend_Db_Table_Abstract
{
	protected $_name = 'book_hotel';

	protected $_referenceMap=array('user'=>array(
        'columns'=>array('user_id'),
        'refTableClass'=>'Application_Model_User',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));


}

