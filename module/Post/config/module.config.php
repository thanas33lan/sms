<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Post\Controller\Post' => 'Post\Controller\PostController',
        ),
    ),

    // Controller config
    'router' => array(
        'routes' => array(
            'Post' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/post[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Post\Controller\Post',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
