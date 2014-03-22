<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 20.3.2014
 * Time: 21:38
 */

namespace App\Presenters;


class FilePresenter extends BasePresenter{

	public function actionDefault()
	{
		$this->template->file = array(
			'name' => 'tema.doc',
			'type' => 'doc',
			'url' => '/0.0.1/tema.doc',
			'created' => '2014-03-03'
		);
		$this->template->count = 1;
	}
        
        public function actionAdd()
        {
            $this->template->id = 1;
        }

} 