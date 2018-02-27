<?php

namespace Blog;

return [
    'router' => [
        'routes' => [
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'blog' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/blog',
                    'defaults' => [
                        '__NAMESPACE__' => 'Blog\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'page'          => 1,
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                    'paged' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/page/:page',
                            'constraints' => [
                                'page' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Blog\Controller\index',
                                'action' => 'index'
                            ]
                        ]
                    ]
                ],
            ],
            'display-post' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/blog/posts/:categorySlug/:postSlug',
                    'constraints' => [
                        'categorySlug' => '[a-zA-Z0-9-]+',
                        'postSlug' => '[a-zA-Z0-9-]+',
                    ],
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'viewPost'
                    ]
                ]
            ],
            'edit' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/blog/edit/:postId',
                    'constraints' => [
                        'postId' => '[0-9]+',

                    ],
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'edit'
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Blog\Controller\Index' => Controller\IndexController::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
