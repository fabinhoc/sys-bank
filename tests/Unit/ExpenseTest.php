<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\ClientData;

class ExpenseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Athenticate user Fabio Cruz
     *
     * @return Array
     */
    private function login(): Array
    {
        $clientData = new ClientData();
        $request = $clientData->getData();

        $response = $this->post('/oauth/token', $request);
        return json_decode($response->content(), true);
    }
    
    /**
     * EXPENSES CREATE
     *
     * @return void
     */
    public function testCreate(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        $response = $this->get('/api/user', ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);

        $data = [
            'name' => 'Conta de luz',
            'price' => 120.00,
            'user_id' => $resource['id']
        ];
        $response = $this->post('/api/expenses', $data, ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['name', 'price', 'user_id', 'updated_at', 'created_at', 'id']);
    }
    
    /**
     * EXPENSE UPDATE
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        // GET AN USER
        $response = $this->get('/api/user', ['Authorization' => 'Bearer ' . $token]);
        $userResource = json_decode($response->content(), true);

        // REGISTER AN EXPENSE
        $data = [
            'name' => 'Conta de luz',
            'price' => 120.00,
            'user_id' => $userResource['id']
        ];
        $response = $this->post('/api/expenses', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];

        // EDIT AN EXPENSE
        $data = [
            'name' => 'Conta de luz 10/02',
            'price' => 120.00,
            'user_id' => $userResource['id']
        ];
        $response = $this->put("/api/expenses/{$id}", $data, ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200);
    }

    /**
     * EXPENSES LIST
     *
     * @return void
     */
    public function testList(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        // GET AN USER
        $response = $this->get('/api/user', ['Authorization' => 'Bearer ' . $token]);
        $userResource = json_decode($response->content(), true);

        // REGISTER AN EXPENSE
        $data = [
            'name' => 'Conta de luz',
            'price' => 120.00,
            'user_id' => $userResource['id']
        ];
        $response = $this->post('/api/expenses', $data, ['Authorization' => 'Bearer ' . $token]);

        $response = $this->get('/api/expenses', ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['*' => ['name', 'price', 'user_id', 'updated_at', 'user', 'created_at', 'id']]);
    }

    /**
     * EXPENSES SHOW
     *
     * @return void
     */
    public function testShow(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        // GET AN USER
        $response = $this->get('/api/user', ['Authorization' => 'Bearer ' . $token]);
        $userResource = json_decode($response->content(), true);

        // REGISTER AN EXPENSE
        $data = [
            'name' => 'Conta de luz',
            'price' => 120.00,
            'user_id' => $userResource['id']
        ];
        $response = $this->post('/api/expenses', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];
        
        $response = $this->get("/api/expenses/{$id}", ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'name', 'price', 'user_id', 'user', 'created_at', 'updated_at']);
    }

    /**
     * delete expense
     *
     * @return void
     */
    public function testDestroy(): void
    {
        $token = $this->login();
        $token = $token['access_token'];

        // GET AN USER
        $response = $this->get('/api/user', ['Authorization' => 'Bearer ' . $token]);
        $userResource = json_decode($response->content(), true);

        // REGISTER AN EXPENSE
        $data = [
            'name' => 'Conta de luz',
            'price' => 120.00,
            'user_id' => $userResource['id']
        ];
        $response = $this->post('/api/expenses', $data, ['Authorization' => 'Bearer ' . $token]);
        $resource = json_decode($response->content(), true);
        $id = $resource['id'];
        
        $response = $this->delete("/api/expenses/{$id}", ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }
}
