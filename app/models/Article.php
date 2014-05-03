<?php

namespace Models;

class Article extends Base
{

	public function getArticles()
	{
		$articles = $this->getAll()->where('user_id', $this->user->getId())->order('created ASC');
		return $articles;
	}

	public function addEdit($values, $id = NULL)
	{
		if(is_null($id)) {
			return $this->getTable()->insert($values);
		} else {
			$task = $this->getTable()->get($id);
			return $task->update($values);
		}
	}
}