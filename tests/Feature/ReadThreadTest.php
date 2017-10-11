<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadTest extends TestCase {
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();

        $this->thread = factory( 'App\Thread' )->create();
    }

    public function test_a_user_can_view_all_threads(){
        $this->get( '/threads' )
            ->assertSee( $this->thread->title );
    }

    public function test_a_user_can_view_a_single_thread(){
        $this->get( $this->thread->path() )
            ->assertSee( $this->thread->title );
    }

    public function test_a_user_can_view_replies_that_are_associated_with_a_thread(){
        $reply = factory( 'App\Reply' )->create( [ 'thread_id' => $this->thread->id ] );

        $this->get( $this->thread->path() )
            ->assertSee( $reply->body );
    }
}
