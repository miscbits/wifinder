<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HotspotAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'hotspots');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('hotspots');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'hotspots/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'hotspots', $this->Hotspot->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('hotspots/'.$this->Hotspot->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'hotspots', $this->Hotspot->toArray());

        $response = $this->actor->call('GET', '/hotspots/'.$this->Hotspot->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('hotspot');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'hotspots', $this->Hotspot->toArray());
        $response = $this->actor->call('PATCH', 'hotspots/1', $this->HotspotEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('hotspots', $this->HotspotEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'hotspots', $this->Hotspot->toArray());

        $response = $this->call('DELETE', 'hotspots/'.$this->Hotspot->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('hotspots');
    }

}
