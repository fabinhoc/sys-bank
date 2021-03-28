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
    
    // public function testCreate()
    // {
    //     $token = $this->login();
    //     $token = $token['access_token'];
    // }
}
