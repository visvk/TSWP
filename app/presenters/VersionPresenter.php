<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:09
 */

namespace App\Presenters;

use Nette\Application\UI\Form;

class VersionPresenter extends BasePresenter {

	public function actionDefault()
	{
		$this->template->version = array(
			'version' => '0.0.1',
			'created' => '2014-03-03'
		);
		$this->template->count = 1;
	}

	public function createComponentAddEditVersionForm()
	{
		$form = new Form;
		$form->addText('version', 'Verzia')
			->addRule(Form::FILLED,'Zadajte názov.');
		$form->addTextArea('description','Popis');
		$form->addSubmit('submit', 'Vytvoriť');
		$form->onSuccess[] = $this->processAddEditVersionForm;
		return $form;
	}

	public function processAddEditVersionForm(Form $form)
	{
		$values = $form->getValues();
		$this->redirect('this');
	}

} 