<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Tag;

class ProductTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * Check if a new product can be created
     * @test
     */
    public function check_if_new_product_can_be_created()
    {
        $product = Product::create(['name' => 'Laptop']);

        $this->assertEquals('Laptop', $product->name);
        $this->assertDatabaseHas('products', ['name' => 'Laptop']);
    }

    /**
     * Check if a new tag can be created
     * @test
     */
    public function check_if_new_tag_can_be_created()
    {
        $tag = Tag::create(['name' => 'Electronics']);

        $this->assertEquals('Electronics', $tag->name);
        $this->assertDatabaseHas('tags', ['name' => 'Electronics']);
    }

    /**
     * Check if a product can have multiple tags
     * @test
     */
    public function check_if_product_can_have_multiple_tags()
    {
        $product = Product::create(['name' => 'Laptop']);
        $tag1 = Tag::create(['name' => 'Electronics']);
        $tag2 = Tag::create(['name' => 'Computing']);

        $product->tags()->attach([$tag1->id, $tag2->id]);

        $this->assertCount(2, $product->tags);
        $this->assertEquals('Electronics', $product->tags->first()->name);
    }

    /**
     * Check if a tag can belong to multiple products
     * @test
     */
    public function check_if_tag_can_belong_to_multiple_products()
    {
        $tag = Tag::create(['name' => 'Electronics']);
        $product1 = Product::create(['name' => 'Laptop']);
        $product2 = Product::create(['name' => 'Smartphone']);

        $tag->products()->attach([$product1->id, $product2->id]);

        $this->assertCount(2, $tag->products);
    }

    /**
     * Check if product tags can be synced
     * @test
     */
    public function check_if_product_tags_can_be_synced()
    {
        $product = Product::create(['name' => 'Laptop']);
        $tag1 = Tag::create(['name' => 'Electronics']);
        $tag2 = Tag::create(['name' => 'Computing']);

        $product->tags()->sync([$tag1->id, $tag2->id]);
        $this->assertCount(2, $product->fresh()->tags);

        $product->tags()->sync([$tag1->id]);
        $this->assertCount(1, $product->fresh()->tags);
    }

    /**
     * Check if products index page is accessible
     * @test
     */
    public function check_if_products_index_is_accessible()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $this->get(route('products.index'))
            ->assertResponseStatus(200);
    }

    /**
     * Check if tags index page is accessible
     * @test
     */
    public function check_if_tags_index_is_accessible()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $this->get(route('tags.index'))
            ->assertResponseStatus(200);
    }

    /**
     * Check if report tags page is accessible
     * @test
     */
    public function check_if_report_tags_is_accessible()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $this->get(route('reports.tags'))
            ->assertResponseStatus(200);
    }

    /**
     * Check if a product can be created via route
     * @test
     */
    public function check_if_product_can_be_created_via_route()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $this->post(route('products.store'), ['name' => 'New Product'])
            ->assertResponseStatus(302);

        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    /**
     * Check if a tag can be created via route
     * @test
     */
    public function check_if_tag_can_be_created_via_route()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $this->post(route('tags.store'), ['name' => 'New Tag'])
            ->assertResponseStatus(302);

        $this->assertDatabaseHas('tags', ['name' => 'New Tag']);
    }

    /**
     * Check if a product can be deleted
     * @test
     */
    public function check_if_product_can_be_deleted()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $product = Product::create(['name' => 'ToDelete']);
        $this->delete(route('products.destroy', $product->id))
            ->assertResponseStatus(302);

        $this->assertDatabaseMissing('products', ['name' => 'ToDelete']);
    }

    /**
     * Check if a tag can be deleted
     * @test
     */
    public function check_if_tag_can_be_deleted()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $tag = Tag::create(['name' => 'ToDelete']);
        $this->delete(route('tags.destroy', $tag->id))
            ->assertResponseStatus(302);

        $this->assertDatabaseMissing('tags', ['name' => 'ToDelete']);
    }
}
