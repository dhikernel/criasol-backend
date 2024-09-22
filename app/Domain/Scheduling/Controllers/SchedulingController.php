<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Controllers;

use App\Domain\Scheduling\Repositories\SchedulingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulingController extends Controller
{
    protected SchedulingRepository $repository;

    protected array $validators = [
        'doctor_id' => 'nullable|integer',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:scheduling',
        'animal_name' => 'required|string|max:255',
        'animal_type' => 'required|string|max:255',
        'age' => 'nullable|integer',
        'symptoms' => 'nullable|string|max:65535',
        'date' => 'nullable|date',
        'period' => 'required|string|in:manhã,tarde',
    ];

    /**
     * @param SchedulingRepository $repository
     */
    public function __construct(SchedulingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return parent::index($request);
    }

    public function store(Request $request)
    {
        return parent::store($request);
    }

    public function update(Request $request, int $id)
    {
        return parent::update($request, $id);
    }

    public function destroy(int $id)
    {
        return parent::destroy($id);
    }
}
