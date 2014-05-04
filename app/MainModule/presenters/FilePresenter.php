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
		$this->template->version = $this->versionModel->get($versionId);
		$this->template->count = $this->template->files->count();
	}

	public function actionAdd()
	{
		$this->template->id = 1;
	}
	public function handleDownloadFile($fileId) {
		$fileDat= $this->fileModel->get($fileId);

		$file = $this->context->parameters['wwwDir'].'/../storage/files/'. $fileDat->url;
		$fileName = $fileDat->name.'.'.$fileDat->type;
		$httpResponse = $this->context->getService('httpResponse');
		$httpResponse->setHeader('Pragma', "public");
		$httpResponse->setHeader('Expires', 0);
		$httpResponse->setHeader('Cache-Control', "must-revalidate, post-check=0, pre-check=0");
		$httpResponse->setHeader('Content-Transfer-Encoding', "binary");
		$httpResponse->setHeader('Content-Description', "File Transfer");
		if( $httpResponse->setHeader('Content-Length', filesize($file)) &&
			$this->sendResponse(new FileResponse($file,$fileName ,'application/octet-stream,application/force-download, application/download'))
		){$this->flashMessage('Súbor stiahnutý.', 'success');
		}else{
			$this->flashMessage('Problém pri sťahovaní súboru.', 'error');
		}
		if (!$this->presenter->isAjax()) {

			$this->presenter->redirect('this');
		}

		$this->invalidateControl();
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
		$values['version_id'] = $versionId = $this->presenter->getParameter("versionId");
//		$values['type'] = "file";
//		$values['url'] = "/store/file";
//		unset($values['file']);
//		$this->fileModel->addEdit($values);
//		$this->redirect('this');
		$version = $this->versionModel->get($versionId);
		//////
//		$values = $form->getValues();
//		$taskId = $this->presenter->getParameter('taskId');
//		$themeId = $this->presenter->getParameter('themeId');
		//Max file count, default 1, for task.
//		$maxFileCount = 1;



		if($values['file']->isOk() && $version){
			$values['type'] = pathinfo($values['file']->getName(), PATHINFO_EXTENSION);
			$values['file_name'] = Strings::webalize($values['name'].'_'.new DateTime()).'.'.$values['type']; //TODO: datum na Y-m-d
			$urlArticle = Strings::webalize('article_blabla', NULL, FALSE);
			$urlVersion = Strings::webalize('version_'.$version->version_1.'-'.$version->version_2, NULL, FALSE);
			$URL = $urlArticle.'/'.$urlVersion;
			if (!file_exists($this->context->parameters['wwwDir'] . '/../storage/files/'.$URL)) {
				mkdir($this->context->parameters['wwwDir'] . '/../storage/files/'.$URL, 0777, true);
			}
			$values['url'] = $URL.'/'.$values['file_name'];
			$values['file']->move($this->context->parameters['wwwDir'] . '/../storage/files/'.$values['url']);

			//DB ukladanie
			unset($values['file']);
			unset($values['file_name']);

			$values['created'] = new \Nette\DateTime;
			$this->fileModel->addEdit($values);
			$this->versionModel->update($versionId, array("version_2" => $version->version_2 + 1));
			$this->articleModel->update($version->article_id, array("actual_version" =>  $version->version_1 . "." . ($version->version_2 + 1)));
			$this->flashMessage("Súbor nahratý");
		}else {
			$this->flashMessage("CHYBA súboru");
		}
		unset($values['name']);

		$this->presenter->redirect('this');
	}

} 