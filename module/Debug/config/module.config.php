<?php
/**
 * 
 * @package Debug
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Debug\Controller\Debug' => 'Debug\Controller\DebugController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'debug' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/debug[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Debug\Controller\Debug',
                        'action'     => 'index',
                        'action'     => 'search',
                        'action'     => 'recent',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'debug' => __DIR__ . '/../view',
        ),
    ),
);
?>
