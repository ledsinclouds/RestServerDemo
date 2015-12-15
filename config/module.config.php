<?php

return array(
	'session' => array(
		'use_cookies' => true,
		'use_only_cookies' => true,
		'cookie_httponly' => true,
		'cookie_secure' => false,
		'name' => 'ZF2_SESSION',
		'save_path' => __DIR__ . '/../../../data/session'		
	),
    'router' => array(
        'routes' => array(
            'album' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/albums[/:id]',
                    'defaults' => array(
                        'controller' => 'RestServerDemo\Controller\Index',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'songs' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/album[/:id]/songs',
                    'defaults' => array(
                        'controller' => 'RestServerDemo\Controller\Songs',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ), 
            'song' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/song[/:id]',
                    'defaults' => array(
                        'controller' => 'RestServerDemo\Controller\SingleSong',
                    ),
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                ),
            ),                                  
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'RestServerDemo\Controller\Index' => 'RestServerDemo\Controller\IndexController',  
            'RestServerDemo\Controller\Songs' => 'RestServerDemo\Controller\SongsController',  
            'RestServerDemo\Controller\SingleSong' => 'RestServerDemo\Controller\SingleSongController',                                
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'display_not_found_reason' => true,
        'display_exceptions'       => true,      
    ),    
    'doctrine' => array(
        'driver' => array(
            'Album_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/RestServerDemo/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'RestServerDemo\Entity' => 'Album_driver',
                ),
            ),
		),
	),    
);
