<?php

use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

Debug::enable();

$kernel = new Kernel('dev', true);
$request = Request::createFromGlobals();
$request->setMethod('POST');

$kernel->boot();
/** @var \Symfony\Component\HttpKernel\EventListener\RouterListener $routerListener */
$routerListener = $kernel->getContainer()->get('router_listener_alias');
$rc = new ReflectionClass($routerListener);
$prop = $rc->getProperty('context');
$prop->setAccessible(true);
$prop->setValue($routerListener, new \Symfony\Component\Routing\RequestContext());

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
