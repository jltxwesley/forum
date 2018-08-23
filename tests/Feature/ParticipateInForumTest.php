<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_paticipate_in_forum_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create(\App\Thread::class);

        $reply = make(\App\Reply::class);
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
             ->assertSee($reply->body);
    }
}
