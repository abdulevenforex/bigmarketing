<?php
namespace Dashboard;
return array(
   'router' => array(
         'routes' => array(
             'dash' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/dash[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Dashboard\Controller\Dashboard',
                         
                     ),
                 ),
             ),
         ),
     ),
    'controllers' => array(
        'invokables' => array(
            'Dashboard\Controller\Dashboard'=> 'Dashboard\Controller\DashboardController',
        ),
    ),
   
    'view_manager' => array(
         'template_path_stack' => array(
             'dashboard' => __DIR__ . '/../view',
         ),
     ),
 );
    

/*return array(
     'controllers' => array(
         'invokables' => array(
              'Dashboard\Controller\Dashboard'   => 'Dashboard\Controller\DashboardController',
         ),
     ),
  
     'router' => array(
         'routes' => array(
             'user' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/dashboard[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Dashboard\Controller\Dashboard',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
  
    'view_manager' => array(
         'template_path_stack' => array(
             'dashboard' => __DIR__ . '/../view',
         ),
     ),
/*'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
 );*/
?>