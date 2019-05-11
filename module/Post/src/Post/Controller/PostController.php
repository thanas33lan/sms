<?php

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PostController extends AbstractRestfulController
{
    public function addAction() 
    {
        $params = json_decode(file_get_contents('php://input'));
        $postService = $this->getServiceLocator()->get('PostService');
        $response =$postService->addNewPostDetailsAPI($params);
        return new JsonModel($response);
    }
    
    public function getAction() 
    {
        $params=$this->getRequest()->getQuery();
        $postService = $this->getServiceLocator()->get('PostService');
        $response =$postService->getPostDetailsByIdAPI($params);
        return new JsonModel($response);
    }
    
    public function deleteAction() 
    {
        $params = json_decode(file_get_contents('php://input'));
        $postService = $this->getServiceLocator()->get('PostService');
        $response =$postService->deletePostDetailsByIdAPI($params);
        return new JsonModel($response);
    }
}