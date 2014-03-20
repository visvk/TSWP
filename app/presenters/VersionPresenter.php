<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:09
 */

namespace App\Presenters;


class VersionPresenter extends BasePresenter {

	public function actionDefault()
	{
		$this->template->version = array(
			'version' => '0.0.1',
			'created' => '2014-03-03'
		);
		$this->template->count = 1;
	}

} 