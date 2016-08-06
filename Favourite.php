<?php

class Favourite {
	
	private $_favourites;

	public function load()
	{
		$this->_favourites = file_get_contents(__DIR__ . '/data/favourites.json');
		return $this;
	}

	public function raw()
	{
		if (empty($this->_favourites))
		{
			$this->load();
		}
		return $this->_favourites;
	}

	public function save()
	{

		if (empty($this->_favourites))
		{
			$this->load();
		}

		return (file_put_contents(__DIR__ . '/data/favourites.json', json_encode($this->raw(), JSON_PRETTY_PRINT)) !== FALSE);
	}

	public function add($newRecord = [])
	{
		if (empty($this->_favourites))
		{
			$this->load();
		}

		$this->_favourites = array_merge(json_decode($this->_favourites,true), [$newRecord]);

		return $this;
	}


}