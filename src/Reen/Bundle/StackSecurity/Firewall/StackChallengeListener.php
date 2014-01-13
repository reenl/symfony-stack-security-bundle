<?php
namespace Reen\Bundle\StackSecurity\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;

class StackChallengeListener implements ListenerInterface
{
    /**
     * @param GetResponseEvent $event
     * @return void
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->attributes->has('stack.authn.token')) {
            // Token, given no need to request a challenge.
            return;
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        $response->headers->set('WWW-Authenticate', 'Stack');
        $event->setResponse($response);
    }
}