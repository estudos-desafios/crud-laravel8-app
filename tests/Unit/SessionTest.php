<?php

namespace Tests\Unit;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SessionTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * Check if a new session record can be created
     * @test
     */
    public function check_if_new_session_can_be_created(): void
    {
        $user = \App\Models\User::factory()->create();
        $now = time();

        $session = Session::create([
            'id'            => Str::random(40),
            'user_id'       => $user->id,
            'ip_address'    => '127.0.0.1',
            'user_agent'    => 'PHPUnit',
            'payload'       => 'test-payload',
            'last_activity' => $now,
        ]);

        $this->assertEquals($user->id, $session->user_id);
        $this->assertEquals('127.0.0.1', $session->ip_address);
    }

    /**
     * Verify that the last_login accessor formats the timestamp correctly
     * @test
     */
    public function verify_last_login_attribute_formats_timestamp(): void
    {
        $user = \App\Models\User::factory()->create();
        $timestamp = Carbon::create(2022, 6, 15, 10, 30, 0, 'UTC');

        $session = Session::create([
            'id'            => Str::random(40),
            'user_id'       => $user->id,
            'ip_address'    => '127.0.0.1',
            'user_agent'    => 'PHPUnit',
            'payload'       => 'test-payload',
            'last_activity' => $timestamp->timestamp,
        ]);

        // The accessor formats the date as d-m-Y H:i:s in America/Sao_Paulo timezone
        $expected = $timestamp->copy()->setTimezone('America/Sao_Paulo')->format('d-m-Y H:i:s');
        $this->assertEquals($expected, $session->last_login);
    }

    /**
     * Verify that a session belongs to a user
     * @test
     */
    public function verify_session_belongs_to_user(): void
    {
        $user = \App\Models\User::factory()->create();

        $session = Session::create([
            'id'            => Str::random(40),
            'user_id'       => $user->id,
            'ip_address'    => '10.0.0.1',
            'user_agent'    => 'PHPUnit',
            'payload'       => 'test-payload',
            'last_activity' => time(),
        ]);

        $this->assertEquals($user->id, $session->users->id);
        $this->assertEquals($user->email, $session->users->email);
    }
}
