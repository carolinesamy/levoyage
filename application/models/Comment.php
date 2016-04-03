<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{

    protected $_name="comment";
    protected $_referenceMap=array('experience'=>array(
        'columns'=>array('exp_id'),
        'refTableClass'=>'Application_Model_Experience',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ),
        'user'=>array(
            'columns'=>array('user_id'),
            'refTableClass'=>'Application_Model_User',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'
        )
        );



}

