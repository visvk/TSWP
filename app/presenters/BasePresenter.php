<?php

//namespace App\Presenters;
/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	protected $fileModel;
	protected $userModel;
	protected $versionModel;
	protected $articleModel;

	public function injectBase(Models\File $file, Models\Article $article, Models\Version $version, Models\User $user)
	{
		$this->fileModel = $file;
		$this->userModel = $user;
		$this->articleModel = $article;
		$this->versionModel = $version;
	}
}