<?php
namespace  Mov\MainModule\Presenters;

use Nette;
/**
 * Base presenter for all application presenters.
 */
class BasePresenter extends \BasePresenter
{

	public function startup()
	{
		parent::startup();
		$user = $this->getUser();
		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent("Sign:in")) {
			$this->redirect(":Main:Sign:in");
		}
	}


}
