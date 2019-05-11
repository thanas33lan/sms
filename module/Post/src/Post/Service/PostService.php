<?php
namespace Post\Service;

use Zend\Session\Container;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Exception;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class PostService {

    public $sm = null;

    public function __construct($sm) {
        $this->sm = $sm;
    }

    public function getServiceManager() {
        return $this->sm;
    }

    public function addNewPostDetailsAPI($params)
    {
        $PostDb = $this->sm->get('PostTable');
        $result = $PostDb->addPostDetailsAPI($params);
        return $result;
    }
    
    public function getPostDetailsByIdAPI($params)
    {
        $PostDb = $this->sm->get('PostTable');
        return $PostDb->fetchPostDetailsByIdAPI($params);
    }
    
    public function deletePostDetailsByIdAPI($params)
    {
        $PostDb = $this->sm->get('PostTable');
        return $PostDb->fetchPostDetailsByIdAPI($params);
    }
}
