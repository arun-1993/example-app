<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome To Laravel!');
        $response->assertSeeText('This is the content of the home page.');
    }

    public function test_contact_page()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Welcome to Contact!');
        $response->assertSeeText('This is the content of the contact page.');
    }
}
