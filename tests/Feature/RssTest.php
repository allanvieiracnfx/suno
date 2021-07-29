<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RssTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_property()
    {

        $body = [
            'rss_url' => 'https://g1.globo.com/rss/g1/economia/'
        ];

        $uri = '/api/rss/notices/list';

        $response = $this->post($uri, $body);
        $values = json_decode($response->getContent());
        $obj = get_object_vars($values[0]);
        
        $title = null;
        $data = null;
        $link = null;

        foreach ($obj as $key => $value){

            switch($key){
                case 'title':
                    $title = $key;
                break;
                case 'data':
                    $data = $key;
                break;
                case 'link':
                    $link = $key;
                break;
            }
        }

        $this->assertTrue($title == 'title');
        $this->assertTrue($data == 'data');
        $this->assertTrue($link == 'link');

        $response->assertStatus(200);
    }
}
