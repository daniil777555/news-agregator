<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A status test.
     * 
     * @dataProvider uries

     * @return void
     */
    public function test_status($url ,$expected)
    {
        $response = $this->get($url);
        $response->assertStatus($expected);
    }

    /**
     * Required store data validation provider.
     *
     * @return \string[][]
     */
    public function uries()
    {
        return [
            ["/", 200],
            ["/ddd", 404],
            ["rr", 404],
            ["/?hashtag=car", 200],
            ["/administration", 200],
        ];
    }


    /**
     * A views test.
     * 
     * @return void
     */
    public function test_view()
    {
        $response = $this->get('/', ['news' => []]);

        $response->assertViewHasAll(["news"]);
    }


}
