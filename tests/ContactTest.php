<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../ContactDirectory.php';
require_once __DIR__ . '/../Favourite.php';

use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    protected $contacts;

    protected function setUp()
    {
        $this->contacts = [];
    }

    /**
     * /usr/local/bin/phpunit --filter it_can_list_users_from_contacts description tests/ContactTest.php
     * @test
     */
    public function it_can_list_users_from_contacts()
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
     * /usr/local/bin/phpunit --filter it_can_list_users_from_favourites description tests/ContactTest.php
     * @test
     */
    public function it_can_list_users_from_favourites()
    {
        // GIVEN
        // The list of users
        $dataPath = __DIR__ . '/../data/favourites.json';

        // WHEN
        // We visit the list of 
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://localhost:8000/contacts/favourites/');
        
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

    /**
     * /usr/local/bin/phpunit --filter it_can_add_a_user_to_the_favourites_list tests/ContactTest.php
     * @test
     */
    public function it_can_add_a_user_to_the_favourites_list()
    {
        // GIVEN
        // A user in the contacts list
        $dataPath = __DIR__ . '/../data/contacts.json';
        $data = file_get_contents($dataPath);
        $data = json_decode($data, true);
        $user = array_rand($data, 1);
        $targetUserEmail = $data[$user]['email'];

        // WHEN
        // The users email address is posted to end point
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost:8000/contact/favourite/', [
            'form_params' => [
                'email' => $targetUserEmail
            ]
        ]);
echo $res->getBody()->getContents();
        // THEN
        // The user is present in the favourites collection
        $dataPath = __DIR__ . '/../data/favourites.json';
        $data = file_get_contents($dataPath);
        $data = json_decode($data, true);

        $this->assertContains($targetUserEmail, array_column($data, 'email'));
        
    }

}