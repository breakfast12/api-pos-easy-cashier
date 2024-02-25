<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /** @test */
    public function can_login_successfully()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'momokomilada@mailinator.com',
            'password' => 'superadmin123',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
                'token',
                'token_expires_at',
            ],
        ]);

        return $response->json()['data']['token'];
    }

    /** @test */
    public function can_logout_successfully()
    {
        $token = $this->can_login_successfully();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson(route('api.auth.logout'));

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('User Successfully Logout', $response->json()['message']);
    }

    /** @test */
    public function cant_login_cause_email_required()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => '',
            'password' => 'superadmin123',
        ]);

        $response->assertStatus(400);

        $this->assertEquals('Email is required', $response->json()['message']['email'][0]);
    }

    /** @test */
    public function cant_login_cause_email_not_valid()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'momokomilada',
            'password' => 'superadmin123',
        ]);

        $response->assertStatus(400);

        $this->assertEquals('Email must be a valid email address', $response->json()['message']['email'][0]);
    }

    /** @test */
    public function cant_login_cause_email_must_have_domain_extension()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'momokomilada@mailinator',
            'password' => 'superadmin123',
        ]);

        $response->assertStatus(400);

        $this->assertEquals('The email must have a domain extension', $response->json()['message']['email'][0]);
    }

    /** @test */
    public function cant_login_cause_password_required()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'momokomilada@mailinator.com',
            'password' => '',
        ]);

        $response->assertStatus(400);

        $this->assertEquals('Password is required', $response->json()['message']['password'][0]);
    }

    /** @test */
    public function cant_login_cause_email_or_password_invalid()
    {
        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'momokomilada@mailinator.com',
            'password' => 'abc123',
        ]);

        $response->assertUnauthorized();

        $this->assertEquals('failed', $response->json()['status']);
        $this->assertEquals('Invalid Email or Password', $response->json()['message']);
    }
}
