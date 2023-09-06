<?php

namespace App\Services;

use App\Models\Boiler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class BoilerService
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getBoilersPaginated(int $perPage = 4): LengthAwarePaginator
    {
        return Boiler::query()->with('file')->paginate($perPage);
    }

    /**
     * @param Boiler $boiler
     * @return Boiler
     */
    public function getBoiler(Boiler $boiler): Boiler
    {
        return $boiler->with('file')->first();
    }

    /**
     * @param int $id
     * @return Boiler
     */
    public function getBoilerById(int $id): Boiler
    {
        return Boiler::query()->with('file', 'services')->find($id);
    }

    /**
     * @param string $boilerType
     * @param int $bathtubsCount
     * @param int $separateShowersCount
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getSurveyResultBoilersPaginated(string $boilerType, int $bathtubsCount, int $separateShowersCount, int $perPage = 4): LengthAwarePaginator
    {
        $query = Boiler::query();

        if ($boilerType === 'combi')
        {
            if(($bathtubsCount === 1 && $separateShowersCount === 0) || ($bathtubsCount === 0 && $separateShowersCount === 1))
                $query = $query
                    ->with('file')
                    ->whereBetween('heating_output', [24, 30]);

            if(($bathtubsCount === 1 && $separateShowersCount === 1) || ($bathtubsCount === 0 && $separateShowersCount === 2) || ($bathtubsCount === 2 && $separateShowersCount === 0))
                $query = $query
                    ->with('file')
                    ->whereBetween('heating_output', [30, 34]);

            if(($bathtubsCount === 1 && $separateShowersCount >= 2) || ($bathtubsCount === 2 && $separateShowersCount >= 1) || ($bathtubsCount === 3 && $separateShowersCount >= 0) || ($bathtubsCount >= 3 || $separateShowersCount >= 3))
                $query = $query
                    ->with('file')
                    ->where('heating_output', '>=', 35);
        }
        elseif($boilerType === 'standard' || $boilerType === 'system')
        {
            if(($bathtubsCount === 0 && $separateShowersCount === 1) || ($bathtubsCount === 1 && $separateShowersCount === 0))
                $query = $query
                    ->with('file')
                    ->whereBetween('heating_output', [15, 24]);

            if(($bathtubsCount === 1 && $separateShowersCount === 1) || ($bathtubsCount === 0 && $separateShowersCount === 2) || ($bathtubsCount === 2 && $separateShowersCount === 0) || ($bathtubsCount === 2 && $separateShowersCount === 2))
                $query = $query
                    ->with('file')
                    ->whereBetween('heating_output', [24, 30]);

            if($bathtubsCount >= 3 || $separateShowersCount >= 3)
                $query = $query
                    ->with('file')
                    ->where('heating_output', '>=', 30);
        }

        return $query
            ->paginate($perPage);
    }
}
