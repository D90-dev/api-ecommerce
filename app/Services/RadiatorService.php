<?php

namespace App\Services;

use App\Models\Radiator;

class RadiatorService
{
    /**
     * @param string|null $type
     * @param float|null $height
     * @param float|null $length
     * @return array
     */
    public function getParametersData(string $type = null, float $height = null, float $length = null): array
    {
        $types = $this->getTypes($height, $length);
        $heights = $this->getHeights($type, $length);
        $lengths = $this->getLengths($type, $height);

        return [
            'types' => $types,
            'heights' => $heights,
            'lengths' => $lengths,
        ];
    }

    /**
     * @param string $type
     * @param float $height
     * @param float $length
     * @return Radiator
     */
    public function getRadiatorByGivenParameters(string $type, float $height, float $length): Radiator
    {
        return Radiator::query()
            ->where('type', $type)
            ->where('height', $height)
            ->where('length', $length)
            ->first();
    }

    /**
     * @param float|null $height
     * @param float|null $length
     * @return array
     */
    private function getTypes(float $height = null, float $length = null): array
    {
        $types = [];

        $typesRes = Radiator::query();

        if($height)
            $typesRes = $typesRes->where('height', $height);

        if($length)
            $typesRes = $typesRes->where('length', $length);

        $typesRes = $typesRes->get()->pluck('type');

        foreach ($typesRes as $type)
        {
            $types[] = $type;
        }

        return array_unique($types);
    }

    /**
     * @param string|null $type
     * @param float|null $length
     * @return array
     */
    private function getHeights(string $type = null, float $length = null): array
    {
        $heights = [];

        $heightsRes = Radiator::query();

        if($type)
            $heightsRes = $heightsRes->where('type', $type);

        if($length)
            $heightsRes = $heightsRes->where('length', $length);

        $heightsRes = $heightsRes->get()->pluck('height');

        foreach ($heightsRes as $height)
        {
            $heights[] = $height;
        }

        return array_unique($heights);
    }

    /**
     * @param string|null $type
     * @param float|null $height
     * @return array
     */
    private function getLengths(string $type = null, float $height = null): array
    {
        $lengths = [];

        $lengthsRes = Radiator::query();

        if($type)
            $lengthsRes = $lengthsRes->where('type', $type);

        if($height)
            $lengthsRes = $lengthsRes->where('height', $height);

        $lengthsRes = $lengthsRes->get()->pluck('length');

        foreach ($lengthsRes as $length)
        {
            $lengths[] = $length;
        }

        return array_unique($lengths);
    }
}
