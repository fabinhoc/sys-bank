<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Athenticate user Fabio Cruz
     *
     * @return Collection
     */
    private function login(): Array
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
        return json_decode($response->content(), true);
    }
    
    /**
     * user create
     *
     * @return void
     */
    public function testCreate(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['name', 'email', 'updated_at', 'created_at', 'id']);
    }

    /**
     * users list
     *
     * @return void
     */
    public function testList(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $response = $this->get('/api/users', ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['*' => ['name', 'email', 'updated_at', 'created_at', 'id']]);
    }

    /**
     * user update
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];
        
        $dataUpdate = [
            'name' => 'teste upadated',
            'email' => 'teste@teste.com'
        ];
        $response = $this->put("/api/users/{$id}", $dataUpdate, ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

    /**
     * user find by id
     *
     * @return void
     */
    public function testShow(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];
        
        $response = $this->get("/api/users/{$id}", ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'name', 'email', 'created_at', 'updated_at']);
    }
    
    /**
     * delete user
     *
     * @return void
     */
    public function testDestroy(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $data = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'admin'
        ];
        $response = $this->post('/api/users', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];
        
        $response = $this->delete("/api/users/{$id}", ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }
}
