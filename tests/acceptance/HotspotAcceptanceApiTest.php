<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HotspotAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->Hotspot = factory(App\Models\Hotspot::class)->make([
            'id' => '1',
		'city' => 'laravel',
		'place' => 'laravel',
		'ssid' => 'laravel',
		'password' => 'laravel',

        ]);
        $this->HotspotEdited = factory(App\Models\Hotspot::class)->make([
            'id' => '1',
		'city' => 'laravel',
		'place' => 'laravel',
		'ssid' => 'laravel',
		'password' => 'laravel',

        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/hotspots');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/hotspots', $this->Hotspot->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/hotspots', $this->Hotspot->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/hotspots/1', $this->HotspotEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('hotspots', $this->HotspotEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/hotspots', $this->Hotspot->toArray());
        $response = $this->call('DELETE', 'api/v1/hotspots/'.$this->Hotspot->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'hotspot was deleted']);
    }

}
