<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('blocks guest access to farmer ai page', function () {
    $response = $this->get('/user/ai');
    $response->assertRedirect('/login');
});

it('blocks guest access to admin ai page', function () {
    $response = $this->get('/admin/ai');
    $response->assertRedirect('/login');
});

it('allows registered user to access farmer ai page', function () {
    $user = User::create([
        'name' => 'Test Farmer',
        'email' => 'farmer-' . uniqid() . '@test.com',
        'role' => 'user',
        'password' => bcrypt('password')
    ]);
    
    $response = $this->actingAs($user)->get('/user/ai');
    $response->assertOk();
    $response->assertSee('Asisten AI Kakao');
});

it('allows admin user to access admin ai page', function () {
    $admin = User::create([
        'name' => 'Test Admin',
        'email' => 'admin-' . uniqid() . '@test.com',
        'role' => 'admin',
        'password' => bcrypt('password')
    ]);
    
    $response = $this->actingAs($admin)->get('/admin/ai');
    $response->assertOk();
    $response->assertSee('Konsol AI Editor Konten');
});

it('processes farmer chatbot messages with simulation response', function () {
    $user = User::create([
        'name' => 'Test Farmer',
        'email' => 'farmer-' . uniqid() . '@test.com',
        'role' => 'user',
        'password' => bcrypt('password')
    ]);
    
    $response = $this->actingAs($user)->post('/user/ai/chat', [
        'message' => 'Bagaimana cara mencegah biji berjamur?',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['reply']);
    $response->assertSee('Simulasi Perkebunan');
});
