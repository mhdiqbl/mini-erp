<?php

namespace Tests\Feature;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Repository\Product\IProductRepository;
use App\Services\Product\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;

    protected $productRepositoryMock;
    protected $productService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepositoryMock = \Mockery::mock(IProductRepository::class);
        $this->productService = new ProductService($this->productRepositoryMock);
    }

    public function test_create_product_success()
    {
        // Mock the repository method
        $category = Category::first();
        $this->productRepositoryMock->shouldReceive('addProduct')
            ->once()
            ->andReturn(Product::factory()->create([
                'category_id' => $category->id
            ]));

        // Generate fake request data
        $requestData = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(),
            'stock' => $this->faker->randomNumber(),
        ];

        // Call the service method
        $response = $this->productService->createProduct($requestData);

        // Assert the response
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($requestData['name'], $response->getData()->data->name);
//        $this->assertEquals($requestData['description'], $response->getData()->data->description);
//        $this->assertEquals($requestData['price'], $response->getData()->data->price);
//        $this->assertEquals($requestData['stock'], $response->getData()->data->stock);
    }

//    public function test_create_product_error()
//    {
//        // Mock the repository method to throw an exception
//        $this->productRepositoryMock->shouldReceive('addProduct')
//            ->once()
//            ->andThrow(new \Exception('Failed to add product'));
//
//        // Generate fake request data
//        $requestData = [
//            'name' => $this->faker->name,
//            'description' => $this->faker->text,
//            'price' => $this->faker->randomNumber(),
//            'stock' => $this->faker->randomNumber(),
//        ];
//
//        // Call the service method
//        $response = $this->productService->createProduct($requestData);
//
//        // Assert the response
//        $this->assertEquals(500, $response->getStatusCode());
//        $this->assertEquals('Failed to add product', $response->getData()->message);
//
//        // Check if the error is logged
//        $this->assertTrue(Log::getLogger()->hasError('Failed to add product'));
//    }
//
//    public function test_example()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
}
