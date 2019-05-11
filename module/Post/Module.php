<?php
namespace Post;

// Models
use Post\Model\PostTable;

// Service
use Post\Service\CommonService;
use Post\Service\PostService;

class Module
{
    public function getServiceConfig() {
        return array(
             'factories' => array(
                //Table
                'PostTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new PostTable($dbAdapter);
                    return $table;
                },

                //service
                'PostService' => function($sm) {
                    return new PostService($sm);
                },

                'CommonService' => function($sm) {
                    return new CommonService($sm);
                },
             )
        );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
