<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Repositories;

use App\Domain\Scheduling\Models\Scheduling;
use App\Domain\Scheduling\Resources\SchedulingCollection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SchedulingRepository
{
    public function index()
    {
        $query = Scheduling::class;

        $query = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('date', 'date'),
                AllowedFilter::partial('type', 'animal_type'),
            ])
            ->defaultSort('created_at')
            ->paginate(request('per_page', config('settings.AMOUNT_PAGINATE_DEFAULT')))
            ->appends(request()->query());

        $returnSchedulingCollection = new SchedulingCollection($query);

        return $returnSchedulingCollection->resource;
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
