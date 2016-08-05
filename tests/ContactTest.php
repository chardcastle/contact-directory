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
     * /usr/local/bin/phpunit --filter it_can_add_a_new_user_to_the_collection tests/ContactTest.php
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

        $res = $client->request('POST', 'http://localhost:8000/contact/', ['form_params' => $formVars]);

        // THEN
        // The user is visible in the collection
        $users = array_merge(json_decode($data, true), $formVars);
        $this->assertEquals(200, $res->getStatusCode());
        
        $directory = new ContactDirectory();
        $directory->load();
        
        $result = array_merge(json_decode($data,true), [$formVars]);
        $expected = json_decode($directory->raw(),true);

        $this->assertEquals($expected, $result);
        // Reset back to how it was!
        file_put_contents($dataPath, $data);

    }

    public function it_can_add_a_user_to_the_favourites_list()
    {

    }

    public function it_can_search_for_a_user()
    {

    } 
}