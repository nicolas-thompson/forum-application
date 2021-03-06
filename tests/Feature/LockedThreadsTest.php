<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class LockThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function non_administrators_may_not_lock_threads()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'locked' => true
        ])->assertStatus(403);

        $this->assertFalse(!! $thread->fresh()->locked);
    }

    /** @test */
    function administrators_can_lock_threads()
    {
        $user = factory('App\User')->states('administrator')->create();

        $this->signIn($user);

        $thread = create('App\Thread', ['user_id' => $user->id]);

        $this->patch($thread->path(), [
            'locked' => true
        ]);

        $this->assertTrue(!! $thread->fresh()->locked);
    }

    /** @test */
    function once_locked_a_thread_may_not_receive_new_replies ()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $thread->lock();

        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => auth()->id()
        ])->assertStatus(422);
    }

}