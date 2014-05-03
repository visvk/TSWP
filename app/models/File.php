<?php

namespace Models;

class File extends Base
{

	public function getFiles($versionId)
	{
		$files= $this->getAll()->where('version_id', $versionId)->order('name ASC');
		return $files;
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