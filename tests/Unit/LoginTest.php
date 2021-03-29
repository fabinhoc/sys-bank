<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\ClientData;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Athenticate user Fabio Cruz
     *
     * @return void
     */
    public function testLogin()
    {
        $clientData = new ClientData();
        $request = $clientData->getData();

        $response = $this->post('/oauth/token', $request);
        $response->assertStatus(200);
    }
    
    /**
     * Create a new user and authenticate
     *
     * @return void
     */
    public function testAuthenticateAndCreateUser()
    {
        $resource = User::factory()->create()->toArray();

        $clientData = new ClientData();
        $request = $clientData->getData();

        $response = $this->post('/oauth/token', $request);

        $token = json_decode($response->content(), true);
        $data = [
            'name' => 'teste',
            'email' => 'teste@teste1.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token['access_token']]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['name', 'email', 'created_at', 'updated_at', 'id']);
    }

    /**
     * Create a new user and authenticate
     *
     * @return void
     */
    public function testAuthenticateNewUser()
    {
        $resource = User::factory()->create()->toArray();
        
        $clientData = new ClientData();
        $request = $clientData->getData();

        $response = $this->post('/oauth/token', $request);

        $token = json_decode($response->content(), true);
        $data = [
            'name' => 'teste',
            'email' => 'teste@teste1.com',
            'password' => 'adminPasss'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token['access_token']]);

        $user = json_decode($response->content(), true);

        // AUTHENTICATION REQUEST
        $clientData = new ClientData();
        $request = $clientData->getData();

        $request['username'] = $user['email'];
        $request['password'] = $data['password'];

        $response = $this->post('/oauth/token', $request);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token_type', 'expires_in', 'access_token', 'refresh_token']);
    }
}
