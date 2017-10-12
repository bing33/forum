<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase {
    use DatabaseMigrations;

    public function test_an_unauthenticated_user_may_not_create_new_forum_thread(){
        $this->withExceptionHandling();

        $this->get( '/threads/create' )
            ->assertRedirect( '/login' );

        $this->post( '/threads' )
            ->assertRedirect( '/login' );
    }

    public function test_an_authenticated_user_can_create_new_forum_thread(){
        //$this->actingAs( create( 'App\User' ) );
        //$thread = factory( 'App\Thread' )->raw();
        //$this->post( '/threads', $thread );

        $this->signIn();

        $thread = make( 'App\Thread' );
        $this->post( '/threads', $thread->toArray() );

        $this->get( $thread->path() )
            ->assertSee( $thread->title )
            ->assertSee( $thread->body );
    }
}
