<?php

return array(
    'invokables' => array(
        'User\Repository\UserRepository' => 'User\Repository\UserRepositoryImpl',
    ),

    'factories' => array(
        'User\Service\UserService' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceManager) {
            $userService = new \User\Service\UserServiceImpl();
            $userService->setUserRepository($serviceManager->get('User\Repository\UserRepository'));

            return $userService;
        },

        'User\InputFilter\AddUser' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceManager) {
            return new \User\InputFilter\AddUser($serviceManager->get('Zend\Db\Adapter\Adapter'));
        },
    ),
);
