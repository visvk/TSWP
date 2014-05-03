<?php

namespace Models;

class Version extends Base
{

	public function getVersions($articleId)
	{
		$versions = $this->getAll()->where('article_id', $articleId)->order('version_1 ASC, version_2 ASC');
		return $versions;
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