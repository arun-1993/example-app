<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private function createDummyBlogPost($userId = null): BlogPost
    {
        return BlogPost::factory()->new_post()->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);
    }

    public function testNoBlogPost()
    {
        $response = $this->get('/post');
        $response->assertSeeText('No Posts Found!');
    }

    public function testSeeOnePostWithNoComments()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/post');

        // Assert
        $response->assertSeeText('New Title');
        $response->assertSeeText('No Comments Yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title',
        ]);
    }

    public function testSeeOnePostWithComments()
    {
        // Arrange
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);

        // Act
        $response = $this->get('/post');

        // Assert
        $response->assertSeeText('4 Comments');
    }

    public function testStoreValid()
    {
        $params = [
            'title'   => 'Valid title',
            'content' => 'Atleast 10 characters',
        ];

        $this->actingAs($this->user())
            ->post('/post', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Created!');
    }

    public function testStoreFail()
    {
        $params = [
            'title'   => 'x',
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

    public function testUpdateValid()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title'   => 'A new named title',
            'content' => 'Content was changed',
        ];

        $this->actingAs($user)
            ->put("/post/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Updated!');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', [
            'title'   => 'A new named title',
            'content' => 'Content was changed',
        ]);
    }

    public function testDelete()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->actingAs($user)
            ->delete("/post/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post Deleted!');
        // $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertSoftDeleted('blog_posts', $post->getAttributes());
    }
}
