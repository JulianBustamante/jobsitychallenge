<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostedAtScopeApplied(): void
    {
        factory(Post::class)->create()->update(['posted_at' => carbon('yesterday')]);
        factory(Post::class)->create()->update(['posted_at' => carbon('tomorrow')]);

        $isBeforeNow = true;
        foreach (Post::all() as $post) {
            $isBeforeNow = $post->posted_at->lt(now());

            if (! $isBeforeNow) {
                break;
            }
        }

        $this->assertTrue($isBeforeNow);
        $this->assertEquals(1, Post::count());
    }

    public function testPostedAtScopeNotApplied(): void
    {
        $this->actingAsAdmin();

        factory(Post::class)->create()->update(['posted_at' => carbon('yesterday')]);
        factory(Post::class)->create()->update(['posted_at' => carbon('tomorrow')]);

        $isBeforeNow = true;
        foreach (Post::all() as $post) {
            $isBeforeNow = $post->posted_at->lt(now());

            if (! $isBeforeNow) {
                break;
            }
        }

        $this->assertFalse($isBeforeNow);
        $this->assertEquals(2, Post::count());
    }
}
