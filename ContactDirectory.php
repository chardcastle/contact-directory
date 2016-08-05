<?php

class ContactDirectory {
	
	private $_contacts;

	public function load()
	{
		$this->_contacts = file_get_contents(__DIR__ . '/data/contacts.json');
		return $this;
	}

	public function raw()
	{
		if (empty($this->_contacts))
		{
			$this->load();
		}
		return $this->_contacts;
	}

	public function save()
	{

		if (empty($this->_contacts))
		{
			$this->load();
		}

		return (file_put_contents(__DIR__ . '/data/contacts.json', json_encode($this->raw(), JSON_PRETTY_PRINT)) !== FALSE);
	}

	public function search() {}

	public function add($newRecord = [])
	{
		if (empty($this->_contacts))
		{
			$this->load();
		}

		$this->_contacts = array_merge(json_decode($this->_contacts,true), [$newRecord]);

		return $this;
	}

	public function addContact($sourceData = [])
	{
		$params = [
			'forename',
			'surname',
			'email',
			'telephone',
			'address',
		];
		$postVars = [];

		// Basic validation
		if (empty($sourceData))
		{
			return false;
		}

		// Search for matching param in the source data ($_POST) 
		foreach ($sourceData as $param => $value)
		{
			if (in_array($param, $params))
			{
				// Remove SQL injections etc... (make safe)
				$postVars[$param] = filter_var($value, FILTER_SANITIZE_STRING);
			}
		}
		
		$this->add($postVars);
		return $this->save();
	}

	public function favouriteContact() {

	}


}