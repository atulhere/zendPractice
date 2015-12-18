<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\Index' =>
            'Users\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'users' => array(
                'type'
                => 'Literal',
                'options' => array(
// Change this to something specific to
                    'route'
                    => '/users',
                    'defaults' => array(
// Change this value to reflect the
// the controllers for your module are
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller'
                        => 'Index',
                        'action'
                        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
// This route is a sane default when
// as you solidify the routes for your module,
// you may want to remove it and replace it
// specific routes.
                    'default' => array(
                        'type'
                        => 'Segment',
                        'options' => array(
                            'route'
                            =>
                            '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' =>
                                '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'
                                =>
                                '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'users' => __DIR__ . '/../view',
        ),
    ),
);
