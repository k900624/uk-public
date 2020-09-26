<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
     
    /** @test */
    public function a_user_can_browse_articles()
    {
        $response = $this->get('articles');
        $response->assertStatus(200);
        
        /*$article = factory('App\Models\Article')->create();
    
        $response = $this->get('articles');
        $response->assertSee($article->title);*/
    }
}
