<?php
/**
* Zend Framework (http://framework.zend.com/)
*
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

return array(
     'router' => array(
            'routes' => array(
                  'home' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                              'route'    => '/',
                              'defaults' => array(
                                    'controller' => 'Application\Controller\Admin',
                                    'action'     => 'index',
                              ),
                        ),
                  ),

                  'admin' => array(
                        'type' => 'segment',
                        'options' => array(
                              'route' => '/admin[/:action][/][:id]',
                              'defaults' => array(
                                    'controller' => 'Application\Controller\Admin',
                                    'action' => 'index',
                              ),
                        ),
                  ),

                  'login' => array(
                        'type' => 'segment',
                        'options' => array(
                              'route'    => '/login[/:action]',
                              'defaults' => array(
                                    'controller' => 'Application\Controller\Login',
                                    'action' => 'index',
                              ),
                        ),
                  ),
                  
                  'logout' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                        'route'    => '/logout',
                        'defaults' => array(
                              'controller' => 'Application\Controller\Login',
                              'action'     => 'logout',
                              ),
                        ),
                  ),

                  'common' => array(
                        'type' => 'segment',
                        'options' => array(
                        'route' => '/common[/:action][/][:id]',
                        'defaults' => array(
                              'controller' => 'Application\Controller\Common',
                              'action' => 'index',
                              ),
                        ),
                  ),
                  'activate' => array(
                        'type' => 'segment',
                        'options' => array(
                        'route' => '/activate[/:action][/][:id]',
                        'defaults' => array(
                              'controller' => 'Application\Controller\Activate',
                              'action' => 'index',
                              ),
                        ),
                  ),
                  // The following is a route to simplify getting started creating
                  // new controllers and actions without needing to create a new
                  // module. Simply drop new controllers in, and you can access them
                  // using the path /application/:controller/:action
                  'application' => array(
                        'type'    => 'Literal',
                        'options' => array(
                              'route'    => '/application',
                              'defaults' => array(
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'Index',
                                    'action'        => 'index',
                              ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                              'default' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                    'route'    => '/[:controller[/:action]]',
                                    'constraints' => array(
                                          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                          'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                    ),
                                    ),
                              ),
                        ),
                  ),
          ),
     ),
     'service_manager' => array(
          'abstract_factories' => array(
               'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
               'Zend\Log\LoggerAbstractServiceFactory',
          ),
          'aliases' => array(
               'translator' => 'MvcTranslator',
          ),
     ),
     'translator' => array(
          'locale' => 'en_US',
          'translation_file_patterns' => array(
               array(
                    'type'     => 'gettext',
                    'base_dir' => __DIR__ . '/../language',
                    'pattern'  => '%s.mo',
               ),
          ),
     ),


     'controllers' => array(
          'invokables' => array(

               'Application\Controller\Index' => 'Application\Controller\IndexController',
               'Application\Controller\Login' => 'Application\Controller\LoginController',
               'Application\Controller\Admin' => 'Application\Controller\AdminController',
               'Application\Controller\Common' => 'Application\Controller\CommonController',
               'Application\Controller\Activate' => 'Application\Controller\ActivateController',
          ),
     ),
     'controller_plugins' => array(
          'invokables' => array(
               'HasParams' => 'Application\Controller\Plugin\HasParams'
          )
     ),
     'view_manager' => array(
          'display_not_found_reason' => true,
          'display_exceptions'       => true,
          'doctype'                  => 'HTML5',
          'not_found_template'       => 'error/404',
          'exception_template'       => 'error/index',
          'template_map' => array(
               'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
               'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
               'error/404'               => __DIR__ . '/../view/error/404.phtml',
               'error/index'             => __DIR__ . '/../view/error/index.phtml',
          ),
          'template_path_stack' => array(
               __DIR__ . '/../view',
          ),
     ),
     'view_helpers' => array(
          'invokables'=> array(
               'category_helper' => 'Application\View\Helper\CategoryHelper',
          )
     ),
     // Placeholder for console routes
     'console' => array(
          'router' => array(
               'routes' => array(

               ),
          ),
     ),
);
