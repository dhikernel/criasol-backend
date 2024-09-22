<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Repositories;

use App\Domain\Scheduling\Models\Scheduling;
use App\Domain\Scheduling\Resources\SchedulingCollection;
use App\Domain\Scheduling\Support\DoctorRelationships;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @property DoctorRelationships $doctorRelationships
 */

class SchedulingRepository
{
    public function __construct(DoctorRelationships $doctorRelationships)
    {
        $this->doctorRelationships = $doctorRelationships;
    }

    public function index()
    {
        $query = Scheduling::with((new DoctorRelationships())->get());

        $result = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('date', 'date'),
                AllowedFilter::partial('type', 'animal_type'),
                AllowedFilter::partial('id', 'id'),
            ])
            ->defaultSort('created_at')
            ->paginate(request('per_page', config('settings.AMOUNT_PAGINATE_DEFAULT')))
            ->appends(request()->query());

        $returnconteudoTreinamentoCollection = new SchedulingCollection($result);

        return $returnconteudoTreinamentoCollection->resource;
    }

    /**
     * @throws Exception
     */
    public function store(array $data): Scheduling
    {
        try {
            DB::beginTransaction();

            $createdScheduling = Scheduling::create($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            throw new \Exception($exception->getMessage());
        }

        return $createdScheduling;
    }

    public function update(array $data, int $id)
    {
        $updateScheduling = Scheduling::find($id);

        return $updateScheduling->fill($data)->save();
    }

    public function destroy(int $id): bool
    {
        return (bool) Scheduling::destroy($id);
    }
}
