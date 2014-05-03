<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:09
 */

namespace  Mov\MainModule\Presenters;

use Nette\Application\UI\Form;

class VersionPresenter extends BasePresenter {

	public function actionDefault($articleId)
	{
		$this->template->versions = $this->versionModel->getVersions($articleId);
		$this->template->count = 1;
	}

	public function createComponentAddEditVersionForm()
	{
		$form = new Form;
		$form->addText('version_1', 'Verzia')
			->addRule(Form::FILLED,'Zadajte názov.');
		$form->addText('version_2', 'Verzia')
			->addRule(Form::FILLED,'Zadajte názov.');
//		$form->addTextArea('description','Popis');
		$form->addSubmit('submit', 'Vytvoriť');
		$form->onSuccess[] = $this->processAddEditVersionForm;
		return $form;
	}

	public function processAddEditVersionForm(Form $form)
	{
		$values = $form->getValues();
		$values['article_id'] = $this->presenter->getParameter('articleId');
		$this->versionModel->addEdit($values);
		$this->redirect('this');
	}

} 