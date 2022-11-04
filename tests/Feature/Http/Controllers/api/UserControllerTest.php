<?php

namespace Tests\Feature\Http\Controllers\api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Candidate;


class UserControllerTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        $this->withoutExceptionHandling();

        $loginData = ['username' => 'sample', 'password' => 'sample123'];

        $this->json('POST', 'api/login', $loginData)
            ->assertStatus(200);

    }

    public function testUnsuccessfulLogin()
    {
        $this->withoutExceptionHandling();

        $loginData = ['usernam' => 'sample', 'password' => 'sample1234'];

        $this->json('POST', 'api/login', $loginData)
            ->assertStatus(401);

    }

    public function test_candidate_create() {
        
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        $response =$this->postJson('/api/candidates', [
            'name' => 'test',
            'source' => 'test',
            'owner' => 1,
            'created_by' => 1,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'test',
                    'source' => 'test',
                    'owner' => 1,
                    'created_by' => 1,
                ],
            ]);


    }
    

    public function test_candidate_index_manager() {
        
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
     
        $user = User::create([
            'id' => 1,
            'username' => 'sample',
            'password' => 'sample123',
            'last_login' => '2021-11-04 00:00:00',
            'is_active' => 1,
            'role' => 'manager',
        ]);

        $this->actingAs($user);

        $response =$this->getJson('/api/leads')
            ->assertStatus(200);
        }

    public function test_candidate_index_agent() {
            
            $this->withoutExceptionHandling();
            $this->withoutMiddleware();
        
            $user = User::create([
                'id' => 1,
                'username' => 'sample',
                'password' => 'sample123',
                'last_login' => '2021-11-04 00:00:00',
                'is_active' => 1,
                'role' => 'agent',
            ]);

            $candidate = Candidate::create([
                'name' => 'test',
                'source' => 'test',
                'owner' => 1,
                'created_by' => 1,
            ]);

           
            if ($user->role == 'agent') {
             
                $candidates = Candidate::where('owner', $user->id)->get();
                $this->actingAs($user);
                $response =$this->getJson('/api/leads')
                    ->assertStatus(200);

            }

    
            $this->actingAs($user);
    
            $response =$this->getJson('/api/leads')
                ->assertStatus(200);
            }
            





}
