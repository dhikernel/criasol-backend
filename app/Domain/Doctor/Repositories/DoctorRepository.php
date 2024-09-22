<?php

declare(strict_types=1);

namespace App\Domain\Doctor\Repositories;

use App\Domain\Doctor\Models\Doctor;
use App\Domain\Doctor\Resources\DoctorCollection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DoctorRepository
{
    public function index()
    {
        $query = Doctor::class;

        $query = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('doctor_name', 'name'),
                AllowedFilter::partial('specialty_name', 'specialty'),
            ])
            ->defaultSort('created_at')
            ->paginate(request('per_page', config('settings.AMOUNT_PAGINATE_DEFAULT')))
            ->appends(request()->query());

        $returnDoctorCollection = new DoctorCollection($query);

        return $returnDoctorCollection->resource;
    }

    /**
     * @throws Exception
     */
    public function store(array $data): Doctor
    {
        try {
            DB::beginTransaction();

            $createdDoctor = Doctor::create($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            throw new \Exception($exception->getMessage());
        }

        return $createdDoctor;
    }

    public function update(array $data, int $id)
    {
        $updateDoctor = Doctor::find($id);

        return $updateDoctor->fill($data)->save();
    }

    public function destroy(int $id): bool
    {
        return (bool) Doctor::destroy($id);
    }
}
