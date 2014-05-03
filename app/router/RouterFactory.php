<?php

namespace Mov;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;

/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
			$router[] = new Route('index.php', 'Main:Homepage:default', Route::ONE_WAY);

			$router[] = $baseRouter = new RouteList('Main');
			$baseRouter[] = new Route('<presenter>/<action>[/<id>]', array(
				'presenter' => 'Homepage',
				'action'        => 'default'
			));

		}else {

			$router = new SimpleRouter('Main:Sign:in');
		}
		return $router;
	}

}
