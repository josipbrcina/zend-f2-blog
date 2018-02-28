<?php

namespace User\Service;

use User\Entity\User;
use Zend\Authentication\AuthenticationService;

class UserServiceImpl implements UserService
{
    /**
     * @var \User\Repository\UserRepository $userRepository
     */
    protected $userRepository;
    /**
     * @param User $user
     * @return void
     */
    public function add(User $user)
    {
        $this->userRepository->add($user);
    }

    /**
     * @return \User\Repository\UserRepository
     */
    public function getUserRepository()
    {
        return $this->userRepository;
    }

    /**
     * @param \User\Repository\UserRepository $userRepository
     */
    public function setUserRepository($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthenticationService()
    {
        $authenticationAdapter = $this->userRepository->getAuthenticationAdapter();

        return new AuthenticationService(null, $authenticationAdapter);// Storage defaults to session
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return boolean
     */
    public function login($email, $password)
    {
        $authenticationService = $this->getAuthenticationService();
        /**
         * @var \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter $authenticationAdapter
         */
        $authenticationAdapter = $authenticationService->getAdapter();
        $authenticationAdapter->setIdentity($email);
        $authenticationAdapter->setCredential($password);
        $result = $authenticationService->authenticate();

        if ($result->isValid()) {
            $identityObject = $authenticationAdapter->getResultRowObject(null, ['password']);
            // Write into session
            $authenticationService->getStorage()->write($identityObject);
        }

        return false;
    }
}
