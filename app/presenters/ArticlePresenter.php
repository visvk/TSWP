<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:07
 */

namespace App\Presenters;


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

} 