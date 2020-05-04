<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function dump;

class TestController
{
	public function test(Request $request)
	{
		dump($request->attributes->get('_route'));

		return new Response();
	}
}
