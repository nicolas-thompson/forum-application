<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        $thread = create('App\Thread');
        $this->post($thread->path() .  '/subscriptions');
        $this->assertCount(1, $thread->subscriptions);
    }
}