<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavouritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_guest_can_not_favourite_anything()
    {
        $this->withExceptionHandling()
                ->post('replies/1/favourites')
                ->assertRedirect('/login');        
    }

    /** @test */
    function an_authenticated_user_can_favourite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('replies/' . $reply->id . '/favourites');
        $this->assertCount(1, $reply->favourites);
    }

    /** @test */
    function an_authenticated_user_can_unfavourite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $reply->favourite();
        $this->delete('replies/' . $reply->id . '/favourites');
        $this->assertCount(0, $reply->favourites);
    }

    /** @test */
    function an_authenticated_user_may_only_favourite_a_reply_once()
    {
        $this->signIn();
        $reply = create('App\Reply');
        try {
            $this->post('replies/' . $reply->id . '/favourites');
            $this->post('replies/' . $reply->id . '/favourites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice');
        }
        $this->assertCount(1, $reply->favourites);
    }
}
