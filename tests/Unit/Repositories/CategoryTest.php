<?php
namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class CategoryTest extends TestCase
{
    protected $category;
    
    public function setUp() : void
    {
        parent::setUp();
        $this->faker = Faker::create();
        // chuẩn bị dữ liệu test
        $this->category = [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        // khởi tạo lớp CategoryRepository
        $this->categoryRepository = new CategoryRepository();
    }

     /**
     * A basic unit test store
     *
     * @return void
     */
    public function testStore()
    {
        // Gọi hàm tạo
        $category = $this->categoryRepository->storeCategory($this->category);
        // Kiểm tra xem kết quả trả về có là thể hiện của lớp Category hay không
        $this->assertInstanceOf(Category::class, $category);
        // Kiểm tra data trả về
        $this->assertEquals($this->category['name'], $category->name);
        $this->assertEquals($this->category['description'], $category->description);
        // Kiểm tra dữ liệu có tồn tại trong cơ sở dữ liệu hay không
        $this->assertDatabaseHas('categories', $this->category);
    }
    public function testShow()
    {
        $category = Category::factory()->create();
        $found = $this->categoryRepository->showCategory($category->id);
        $this->assertInstanceOf(Category::class, $found);
        $this->assertEquals($found->name, $category->name);
        $this->assertEquals($found->description, $category->description);
    }
    
    public function testUpdate()
    {
       // Tạo dữ liệu mẫu
       $category = Category::factory()->create();
        $newCategory = $this->categoryRepository->updateCategory($this->category, $category);
        // Kiểm tra dữ liệu trả về
        $this->assertInstanceOf(Category::class, $newCategory);
        $this->assertEquals($newCategory->name, $this->category['name']);
        $this->assertEquals($newCategory->description, $this->category['description']);
        // Kiểm tra xem cơ sở dữ liệu đã được cập nhập hay chưa
        $this->assertDatabaseHas('categories', $this->category);
    }

    public function testDestroy()
    {
        $category = Category::factory()->create();
        $deleteCategory = $this->categoryRepository->destroyCategory($category);
        // Kiểm tra dữ liệu có trả về true hay không
        $this->assertTrue($deleteCategory);
        // kiểm tra xem dữ liệu đã được xóa trong cơ sở dữ liệu hay chưa
        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}

