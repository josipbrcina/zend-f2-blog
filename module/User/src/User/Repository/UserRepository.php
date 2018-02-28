<?php

namespace User\Repository;

use Application\Repository\RepositoryInterface;
use User\Entity\User;

interface UserRepository extends RepositoryInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function add(User $user);

    /**
     * @param string $clearPasswordText
     * @return string
     */
    public function generatePassword($clearPasswordText);

    /**
     * @return \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter
     */
    public function getAuthenticationAdapter();
}
