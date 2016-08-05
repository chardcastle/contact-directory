<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    protected $contacts;

    protected function setUp()
    {
        $faker = Faker\Factory::create();

        var_dump($faker->realText());
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
        
        // WHEN
        // We visit the list of 
        

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