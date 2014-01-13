<?php
namespace Reen\Bundle\StackSecurity\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class StackUserToken extends AbstractToken
{
    /**
     * @param array $roles
     */
    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    /**
     * Returns the user credentials.
     *
     * @return mixed The user credentials
     */
    public function getCredentials()
    {
        return '';
    }
}