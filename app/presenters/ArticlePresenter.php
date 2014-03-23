<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:07
 */

namespace App\Presenters;

use Nette\Application\UI\Form;

class ArticlePresenter extends BasePresenter
{

	public function actionDefault()
	{
		$this->template->article = array(
			'name' => 'ExtraOrtoMeta Brutal Tema',
			'description' => 'Vsehovoriaci popis',
			'created' => '2014-03-03'
		);
		$this->template->count = 1;
	}

	public function createComponentAddEditArticleForm()
	{
		$form = new Form;
		$form->addText('name', 'Názov')
			->addRule(Form::FILLED,'Zadajte názov článku.');
		$form->addTextArea('description','Popis');
		$form->addSubmit('submit', 'Vytvoriť');
		$form->onSuccess[] = $this->processAddEditArticleForm;
		return $form;
	}

	public function processAddEditArticleForm(Form $form)
	{
		$values = $form->getValues();
		$this->redirect('this');
	}
} 