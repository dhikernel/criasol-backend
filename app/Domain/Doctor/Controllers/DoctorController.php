<?php

declare(strict_types=1);

namespace App\Domain\Doctor\Controllers;

use App\Domain\Doctor\Repositories\DoctorRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected DoctorRepository $repository;

    protected array $validators = [
        'name' => 'required|string|max:255',
        'specialty' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:doctor',
    ];

    /**
     * @param DoctorRepository $repository
     */
    public function __construct(DoctorRepository $repository)
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
