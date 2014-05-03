<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:38
 */

namespace  Mov\MainModule\Presenters;

use Nette\Application\UI\Form;
use Nette\DateTime;
use Nette\Application\Responses\FileResponse,
	Nette\Utils\Strings;

class FilePresenter extends BasePresenter{

	public function actionDefault($versionId)
	{
		$this->template->files = $this->fileModel->getFiles($versionId);
		$this->template->count = $this->template->files->count();
	}

	public function actionAdd()
	{
		$this->template->id = 1;
	}

	public function createComponentAddEditFileForm()
	{
		$form = new Form;
		$form->addText('name', 'Názov')
			->addRule(Form::FILLED,'Zadajte názov súboru.');
//		$form->addTextArea('description','Popis');
		$form->addUpload('file', 'Dokument')
			->addRule(Form::FILLED,'Musi byt vyplnený.')
			->addRule(Form::MAX_FILE_SIZE, 'Príliš veľký súbor.', 10 * 1024 * 1024);
		//->addRule(Form::MIME_TYPE,'Bad file format.',$parent->context->parameters['mimeTypes']);
		$form->addSubmit('submit', 'Ulož');
		$form->onSuccess[] = $this->processAddEditFileForm;
		return $form;
	}

	public function processAddEditFileForm(Form $form)
	{
		$values = $form->getValues();
		$values['version_id'] = $this->presenter->getParameter("versionId");
		$values['type'] = "file";
		$values['url'] = "/store/file";
		unset($values['file']);
		$this->fileModel->addEdit($values);
		$this->redirect('this');
	}

} 