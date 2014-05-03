<?php
namespace Mov\MainModule\Presenters;

use Nette\Application\UI\Form;

class ArticlePresenter extends BasePresenter
{

	public function actionDefault()
	{
		$this->template->articles = $this->articleModel->getArticles();
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
		$values['user_id'] = $this->user->getId();
                $values['created'] = date('Y-m-d');
		$this->articleModel->addEdit($values);
		$this->redirect('this');
	}
} 