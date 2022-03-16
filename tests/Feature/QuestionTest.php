<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test listing various elements
     *
     * @return void
     */
    public function test_index_users()
    {
        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                            'data', 
                            'current_page',
                            'last_page',
            ]);;
    }
    /**
     * Test listing various elements
     *
     * @return void
     */
    public function test_index_friendships()
    {
        $response = $this->getJson('/api/friendships');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                            'data', 
                            'current_page',
                            'last_page',
            ]);;
    }
    /**
     * Test listing various elements
     *
     * @return void
     */
    public function test_index_user_friendships()
    {
        $response = $this->getJson('/api/users/1/friendships');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                            'data', 
                            'current_page',
                            'last_page',
            ]);;
    }
    /**
     * Test listing various elements
     *
     * @return void
     */
    public function test_index_user_lessons()
    {
        $response = $this->getJson('/api/users/1/lessons');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                            'data', 
                            'current_page',
                            'last_page',
            ]);;
    }

    

}
