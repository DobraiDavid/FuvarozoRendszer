<?php

namespace Tests\Feature;

use App\Models\Fuvarozo;
use App\Models\Munka;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MunkaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Create admin user
        $this->admin = Fuvarozo::create([
            'nev' => 'Admin User',
            'email' => 'admin@test.com',
            'jelszo' => Hash::make('password'),
        ]);

        // Create regular driver
        $this->driver = Fuvarozo::create([
            'nev' => 'Driver User',
            'email' => 'driver@test.com',
            'jelszo' => Hash::make('password'),
        ]);
    }

    /** @test */
    public function admin_can_create_munka()
    {
        $this->actingAs($this->admin, 'fuvarozo');

        $response = $this->post(route('admin.munkak.store'), [
            'indulas' => 'Budapest',
            'erkezes' => 'Debrecen',
            'cimzett_neve' => 'Test User',
            'cimzett_telefonszama' => '+36301234567',
        ]);

        $response->assertRedirect(route('admin.munkak.index'));
        $this->assertDatabaseHas('munka', [
            'indulas' => 'Budapest',
            'erkezes' => 'Debrecen',
        ]);
    }

    /** @test */
    public function admin_can_assign_munka_to_fuvarozo()
    {
        $this->actingAs($this->admin, 'fuvarozo');

        $munka = Munka::create([
            'indulas' => 'Budapest',
            'erkezes' => 'Szeged',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
            'status' => 'kiosztva',
        ]);

        $response = $this->put(route('admin.munkak.update', $munka), [
            'indulas' => 'Budapest',
            'erkezes' => 'Szeged',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
            'status' => 'kiosztva',
            'fuvarozo_id' => $this->driver->id,
        ]);

        $response->assertRedirect(route('admin.munkak.index'));
        $this->assertDatabaseHas('munka', [
            'id' => $munka->id,
            'fuvarozo_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function admin_can_delete_munka()
    {
        $this->actingAs($this->admin, 'fuvarozo');

        $munka = Munka::create([
            'indulas' => 'Budapest',
            'erkezes' => 'Pécs',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
        ]);

        $response = $this->delete(route('admin.munkak.destroy', $munka));

        $response->assertRedirect(route('admin.munkak.index'));
        $this->assertDatabaseMissing('munka', ['id' => $munka->id]);
    }

    /** @test */
    public function fuvarozo_can_update_munka_status()
    {
        $munka = Munka::create([
            'indulas' => 'Budapest',
            'erkezes' => 'Győr',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
            'status' => 'kiosztva',
            'fuvarozo_id' => $this->driver->id,
        ]);

        $this->actingAs($this->driver, 'fuvarozo');

        $response = $this->put(route('fuvarozo.munkak.updateStatus', $munka), [
            'status' => 'folyamatban',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('munka', [
            'id' => $munka->id,
            'status' => 'folyamatban',
        ]);
    }

    /** @test */
    public function fuvarozo_cannot_update_other_fuvarozo_munka()
    {
        $otherDriver = Fuvarozo::create([
            'nev' => 'Other Driver',
            'email' => 'other@test.com',
            'jelszo' => Hash::make('password'),
        ]);

        $munka = Munka::create([
            'indulas' => 'Budapest',
            'erkezes' => 'Sopron',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
            'status' => 'kiosztva',
            'fuvarozo_id' => $otherDriver->id,
        ]);

        $this->actingAs($this->driver, 'fuvarozo');

        $response = $this->put(route('fuvarozo.munkak.updateStatus', $munka), [
            'status' => 'elvegezve',
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function fuvarozo_can_only_see_their_own_munkak()
    {
        Munka::create([
            'indulas' => 'Budapest',
            'erkezes' => 'Kecskemét',
            'cimzett_neve' => 'Test',
            'cimzett_telefonszama' => '+36301234567',
            'fuvarozo_id' => $this->driver->id,
        ]);

        Munka::create([
            'indulas' => 'Szeged',
            'erkezes' => 'Pécs',
            'cimzett_neve' => 'Other Test',
            'cimzett_telefonszama' => '+36307654321',
            'fuvarozo_id' => $this->admin->id,
        ]);

        $this->actingAs($this->driver, 'fuvarozo');

        $response = $this->get(route('fuvarozo.munkak.index'));

        $response->assertStatus(200);
        $response->assertSee('Kecskemét');
        $response->assertDontSee('Pécs');
    }
}