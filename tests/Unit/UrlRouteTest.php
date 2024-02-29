<?php

// tests/Unit/UrlRouteTest.php

namespace Tests\Unit;

use Tests\TestCase;

class UrlRouteTest extends TestCase
{
    /**
     * Kiểm tra xem route '/' có trả về mã HTTP status 200 không.
     *
     * @return void
     */
    public function testHomePageRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Kiểm tra xem route '/posts/{id}' có trả về mã HTTP status 200 không.
     *
     * @return void
     */
    public function testPostDetailRoute()
    {
        $response = $this->get("/posts");

        $response->assertStatus(200);
    }
    public function testUserDetailRoute()
    {
        $response = $this->get("/users");

        $response->assertStatus(200);
    }
}
