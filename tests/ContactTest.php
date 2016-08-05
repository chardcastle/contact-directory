<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../ContactDirectory.php';

use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    protected $contacts;

    protected function setUp()
    {
        $this->contacts = [];
    }

    /**
     * /usr/local/bin/phpunit --filter it_can_list_users_from_the_contacts_file description tests/ContactTest.php
     * @test
     */
    public function it_can_list_users_from_the_contacts_file()
    {
        // GIVEN
        // The list of users
        $dataPath = __DIR__ . '/../data/contacts.json';

        // WHEN
        // We visit the list of 
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://localhost:8000/contacts/');
        
        // THEN 
        // The list of users is the same
        $this->assertJsonStringEqualsJsonFile($dataPath, $res->getBody()->getContents());
        $this->assertEquals(200, $res->getStatusCode());
    }

    /**
     * /usr/local/bin/phpunit --filter it_can_add_a_new_user_to_the_collection description tests/ContactTest.php
     * @test
     */
    public function it_can_add_a_new_user_to_the_collection()
    {
        // GIVEN 
        // Existing users 
        $dataPath = __DIR__ . '/../data/contacts.json';
        $data = file_get_contents($dataPath);

        // Some data for new record
        $faker = Faker\Factory::create();
        $formVars = [
            'forename'  => $faker->firstName,
            'surname'   => $faker->lastName,
            'email'     => $faker->email,
            'telephone' => $faker->phoneNumber,
            'address'   => $faker->address,
        ];

        // WHEN
        // It's posted
        $client = new \GuzzleHttp\Client();
        $res = $client->post('http://localhost:8000/contact/', $formVars);

        // THEN
        // The user is visible in the collection
        $users = array_merge(json_decode($data, true), $formVars);
        $this->assertEquals(200, $res->getStatusCode());
        // var_dump($dataPath);
        var_dump(json_encode($users));
            $directory = new ContactDirectory();
            $directory->load();
        $this->assertJsonStringEqualsJsonFile($dataPath, $directory->raw());
        // Reset back to how it was!
        file_put_contents($dataPath, $data);

    }

    public function it_can_add_a_user_to_the_favourites_list()
    {

    }

    public function it_can_search_for_a_user()
    {

    }    

    // public function testEmpty()
    // {
    //     $this->assertTrue(empty($this->contacts));
    // }

    // public function testPush()
    // {
    //     array_push($this->contacts, 'foo');
    //     $this->assertEquals('foo', $this->contacts[count($this->contacts)-1]);
    //     $this->assertFalse(empty($this->contacts));
    // }

    // public function testPop()
    // {
    //     array_push($this->contacts, 'foo');
    //     $this->assertEquals('foo', array_pop($this->contacts));
    //     $this->assertTrue(empty($this->contacts));
    // }
}