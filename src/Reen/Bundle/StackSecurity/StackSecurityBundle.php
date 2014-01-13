<?php

namespace Reen\Bundle\StackSecurity;

use Reen\Bundle\StackSecurity\DependencyInjection\StackChallengeFactory;
use Reen\Bundle\StackSecurity\DependencyInjection\StackTokenFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class StackSecurityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /* @var $extension \Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension */
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new StackTokenFactory());
        $extension->addSecurityListenerFactory(new StackChallengeFactory());
    }
}
