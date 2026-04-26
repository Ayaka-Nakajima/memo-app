<?php

namespace Tests\Feature;

use App\Models\Memo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_memos(): void
    {
        Memo::create(['title' => 'First', 'content' => 'Hello']);
        Memo::create(['title' => 'Second', 'content' => null]);

        $response = $this->getJson('/api/memos');

        $response->assertStatus(200)
                 ->assertJsonCount(2)
                 ->assertJsonFragment(['title' => 'First']);
    }

    public function test_can_create_memo(): void
    {
        $response = $this->postJson('/api/memos', [
            'title'   => 'Test Memo',
            'content' => 'Some content',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Memo']);

        $this->assertDatabaseHas('memos', ['title' => 'Test Memo']);
    }

    public function test_create_memo_requires_title(): void
    {
        $response = $this->postJson('/api/memos', ['content' => 'No title']);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title']);
    }

    public function test_can_show_memo(): void
    {
        $memo = Memo::create(['title' => 'Show Me', 'content' => 'Detail']);

        $response = $this->getJson("/api/memos/{$memo->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Show Me']);
    }

    public function test_can_update_memo(): void
    {
        $memo = Memo::create(['title' => 'Old Title', 'content' => 'Old content']);

        $response = $this->putJson("/api/memos/{$memo->id}", [
            'title'   => 'New Title',
            'content' => 'New content',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'New Title']);

        $this->assertDatabaseHas('memos', ['title' => 'New Title']);
    }

    public function test_can_delete_memo(): void
    {
        $memo = Memo::create(['title' => 'Delete Me', 'content' => null]);

        $response = $this->deleteJson("/api/memos/{$memo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('memos', ['id' => $memo->id]);
    }
}
