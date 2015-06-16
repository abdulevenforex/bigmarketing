<?php
namespace User;

/*return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                    ),
                ),
            ),            
           
            'login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'login',
                    )
                ),
            ),
            
            'index' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'index',
                    )
                ),
            ),

            'register' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'register',
                    )
                ),
            ),
            
           
            'logout' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'login',
                    )
                ),
            ),
            
                'invalidAccess' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/invalidAccess',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'invalidAccess',
                    )
                ),
            ),
            
             'resetpassword' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/resetpassword',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'resetpassword',
                    )
                ),
            ),
            
               'forgotpassword' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/forgotpassword',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'forgotpassword',
                    )
                ),
            ),
            
              'updateProfile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user/updateProfile',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'updateProfile',
                    )
                ),
            ),
         
             'suggest' => array(
                'type' => 'Segment',
                'options' => array(
                    //'route' => '/user[/][:status]',
                     'route' => '/user/suggest',
                         'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'username'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'suggest',
                    )
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User'   => 'User\Controller\UserController',
        ),
    ),
   
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/User/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'application_entities'
                )
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'User\Entity\User',
                'identity_property' => 'email',
                'credential_property' =>'password'
            ),
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'SendEmailPlugin' => 'User\Controller\Plugin\SendEmailPlugin',
        )
    ),
);*/

return array(
     'controllers' => array(
         'invokables' => array(
              'User\Controller\User'   => 'User\Controller\UserController',
         ),
     ),
  
     'router' => array(
         'routes' => array(
             'user' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/user[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'User\Controller\User',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
  'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/User/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'application_entities'
                )
            )
        ),
  'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'User\Entity\User',
                'identity_property' => 'email',
                'credential_property' =>'password'
            ),
        ),
    ),
   'controller_plugins' => array(
        'invokables' => array(
            'SendEmailPlugin' => 'User\Controller\Plugin\SendEmailPlugin',
        )
    ),
   'view_manager' => array(
         'template_path_stack' => array(
             'user' => __DIR__ . '/../view',
         ),
     ),
/*'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),*/
 );

?>