<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoRoomsControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $r = $this->get('/');
        $r->assertSuccessful();
        $r->assertViewHas('rooms');
    }
}
