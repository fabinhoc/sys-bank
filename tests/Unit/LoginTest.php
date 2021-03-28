<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

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
        $request = [
            'grant_type' => 'password',
            'client_id' => 3, // client id frontend application
            'client_secret' => '3OStvYtflAnsZQd2ZKBePEilXHoNvbUfRsnO0Sjm', // secret frontend application
            'username' => 'fabio@gmail.com', // seedered user
            'password' => 'admin',
            'scope' => ''
        ];

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
        $request = [
            'grant_type' => 'password',
            'client_id' => 3, // client id frontend application
            'client_secret' => '3OStvYtflAnsZQd2ZKBePEilXHoNvbUfRsnO0Sjm', // secret frontend application
            'username' => $resource['email'], // seedered user
            'password' => 'admin',
            'scope' => ''
        ];

        $response = $this->post('/oauth/token', $request);

        $token = json_decode($response->content(), true);
        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
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
        $request = [
            'grant_type' => 'password',
            'client_id' => 3, // client id frontend application
            'client_secret' => '3OStvYtflAnsZQd2ZKBePEilXHoNvbUfRsnO0Sjm', // secret frontend application
            'username' => $resource['email'], // seedered user
            'password' => 'admin',
            'scope' => ''
        ];

        $response = $this->post('/oauth/token', $request);

        $token = json_decode($response->content(), true);
        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token['access_token']]);

        $user = json_decode($response->content(), true);

        // AUTHENTICATION REQUEST
        $request = [
            'grant_type' => 'password',
            'client_id' => 3, // client id frontend application
            'client_secret' => '3OStvYtflAnsZQd2ZKBePEilXHoNvbUfRsnO0Sjm', // secret frontend application
            'username' => $user['email'], // seedered user
            'password' => 'admin', // created user password
            'scope' => ''
        ];

        $response = $this->post('/oauth/token', $request);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token_type', 'expires_in', 'access_token', 'refresh_token']);
    }
}
