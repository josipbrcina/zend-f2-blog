<?php

namespace Blog;

return [
    'invokables' => [
      'Blog\Repository\PostRepository' => 'Blog\Repository\PostRepositoryImpl',
    ],
    'factories' => [
        'Blog\Service\BlogService' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceManager) {
            $blogService = new \Blog\Service\BlogServiceImpl();
            $blogService->setPostRepository($serviceManager->get('Blog\Repository\PostRepository'));

            return $blogService;
        }
    ],
    'initializers' => [
        function($instance, \Zend\ServiceManager\ServiceLocatorInterface $serviceManager) {
            if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                $instance->setDbAdapter($serviceManager->get('Zend\Db\Adapter\Adapter'));
            }
        }
    ]
];
