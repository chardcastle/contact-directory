<?php

require_once __DIR__ . '/ContactDirectory.php';

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

		if ( ! empty($newRecord))
		{
			$this->_favourites = array_merge(json_decode($this->_favourites,true), [$newRecord]);	
		}
		
		return $this;
	}

	public function addFromContactDirectory(ContactDirectory $directory, $postData)
	{
		// Search for matching user in contact directory
		$userData = json_decode($directory->raw());
		$targetUser = array_filter($userData, function($user, $i) use ($postData) {
			// var_dump('Comparing ' . $user->email . ' to ' . $postData['email']);
			return ($user->email === $postData['email']);
		}, ARRAY_FILTER_USE_BOTH);

		// Get first (incase there's many records against same email)
		$user = array_shift($targetUser);
		$this->add((array)$user);

		return $this->save();

	}


}