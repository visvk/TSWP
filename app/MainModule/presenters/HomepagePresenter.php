<?php
//
namespace  Mov\MainModule\Presenters;
use Nette;
use Nette\Application\UI\Form;
use Nette\DateTime;
use Nette\Application\Responses\FileResponse,
	Nette\Utils\Strings;
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
		$date = new Nette\DateTime();
		$this->template->today = $date->format('d.m.Y');
	}

	public function renderFiles()
	{
		$this->template->files = $files = $this->fileModel->getMyFiles();
		$this->template->count = $files->count();
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

	public function handleDeleteFile($fileId)
	{
		$document = $this->fileModel->get($fileId);
		if ($document->name) {
			unlink($this->context->parameters['wwwDir'] . '/../storage/files/'.$document->url);
		}
		$document->delete();
		$this->flashMessage('Súbor zmazaný.', 'success');
		$this->redirect('this');
	}
}
