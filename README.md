# A symfony security provider for STACK

This project contains a simple bundle that enables you to use STACK authentication middlewares.

## Example

In order to secure the default Acme bundle with stack you have to change the `secured_area` within `security.yml`.

It should look like this:

```
secured_area:
    pattern:    ^/demo/secured/
    stack_token: ~
    logout:
        path:   _demo_logout
        target: _demo
    stack_challenge: ~
```

Note that there are 2 stack authenticators given. `stack_token` searches the request for a token, when it is found it will
ask the security provider (default in_memory) to find the user and store it in the security context.

The other authenticator is `stack_challenge` it delegates authentication to the STACK middlewares.

If you like to do a quick test you can alter app_dev.php and make it look like this to authenticate as `user`.

```
<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$request->attributes->set('stack.authn.token', 'user'); // This authenticates you as "user"
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
```

## Questions?

 * irc.freenode.net: ReenL
 * Twitter: https://twitter.com/reenlokum