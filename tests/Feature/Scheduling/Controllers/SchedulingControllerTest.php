<?php

namespace Tests\Feature\Scheduling\Controllers;

use App\Domain\Doctor\Models\Doctor;
use App\Domain\Scheduling\Models\Scheduling;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class SchedulingControllerTest extends TestCase
{
    use WithoutMiddleware;

    protected $repository, $dataScheduling, $dataDoctor, $scheduling, $doctor, $route;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->route       = '/api/scheduling/';
        $this->dataScheduling = Scheduling::factory();
        $this->dataDoctor = Doctor::factory();
    }

    private function prepareEnvironment(): void
    {
        $this->scheduling = Scheduling::factory()->create()->toArray();
        $this->doctor = Doctor::factory()->create()->toArray();
    }

    private function getPayloadScheduling(array $body = []): array
    {
        return array_merge(
            [
                'id' => 1,
                'name' => $this->scheduling['name'],
                'email' => $this->scheduling['email'],
                'animal_name' => $this->scheduling['animal_name'],
                'animal_type' => $this->scheduling['animal_type'],
                'age' => $this->scheduling['age'],
                'symptoms' => $this->scheduling['symptoms'],
                'date' => $this->scheduling['date'],
                'period' => $this->scheduling['period'],
            ],
            $body
        );
    }
    private function getPayloadDoctor(array $body = []): array
    {
        return array_merge(
            [
                'name' => $this->doctor['name'],
                'specialty' => $this->doctor['specialty'],
                'phone' => $this->doctor['phone'],
                'email' => $this->doctor['email'],
            ],
            $body
        );
    }

    public function testIndex()
    {
        $this->get($this->route . 'list')->assertStatus(Response::HTTP_OK);
    }

    public function testStore()
    {
        $this->prepareEnvironment();
        $dataScheduling = $this->getPayloadScheduling();
        $dataDoctor = $this->getPayloadDoctor();
        $data = array_merge($dataScheduling, $dataDoctor);
        $response = $this->post($this->route . 'create', $data);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testUpdate()
    {
        $scheduling = Scheduling::factory()->create();
        $data = [
            'name' => 'Maria Souza',
            'email' => 'maria@example.com',
            'animal_name' => 'Bidu',
            'animal_type' => 'Cachorro',
            'age' => 3,
            'symptoms' => 'Tosse persistente',
            'date' => '2024-09-25',
            'period' => 'Tarde',
        ];
        $response = $this->put($this->route . 'update/' . $scheduling->id, $data);
        $response->assertStatus(Response::HTTP_OK);
    }


    public function testDestroy()
    {
        $this->prepareEnvironment();
        $data = $this->getPayloadScheduling();
        $response = $this->delete($this->route . 'delete/' . $data['id']);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
