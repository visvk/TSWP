<?php
//
namespace  Mov\MainModule\Presenters;
use Nette;
/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
//	public function startup()
//	{
//		parent::startup();
//		$user = $this->getUser();
//		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent("Sign:in")) {
//			$this->redirect("Sign:in");
//		}
//	}

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
