<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private function create_dummy_blog_post()
    {
        return BlogPost::factory()->new_post()->create();
    }

    public function test_no_blog_post()
    {
        $response = $this->get('/post');
        $response->assertSeeText('No Posts Found!');
    }

    public function test_see_one_post_with_no_comments()
    {
        // Arrange
        $post = $this->create_dummy_blog_post();

        // Act
        $response = $this->get('/post');

        // Assert
        $response->assertSeeText('New Title');
        $response->assertSeeText('No Comments Yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title',
        ]);
    }

    public function test_see_one_post_with_comments()
    {
        // Arrange
        $post = $this->create_dummy_blog_post();
        Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);

        // Act
        $response = $this->get('/post');

        // Assert
        $response->assertSeeText('4 Comments');
    }

    public function test_store_valid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'Atleast 10 characters',
        ];

        $this->actingAs($this->user())
            ->post('/post', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Created!');
    }

    public function test_store_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->actingAs($this->user())
            ->post('/post', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function test_update_valid()
    {
        $post = $this->create_dummy_blog_post();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new names title',
            'content' => 'Content was changed',
        ];

        $this->actingAs($this->user())
            ->put("/post/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Updated!');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new names title',
            'content' => 'Content was changed',
        ]);
    }

    public function test_delete()
    {
        $post = $this->create_dummy_blog_post();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->actingAs($this->user())
            ->delete("/post/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Deleted!');
        // $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertSoftDeleted('blog_posts', $post->getAttributes());
    }
}
