<?php

namespace App\Repositories;

use App\Models\DeliveryArea;

class DeliveryAreaRepository
{
    public function create(array $data): DeliveryArea
    {
        return DeliveryArea::create($data);
    }

    public function findOrFail(int $id): DeliveryArea
    {
        return DeliveryArea::findOrFail($id);
    }

    public function update(array $data, int $id): DeliveryArea
    {
        $deliveryArea = $this->findOrFail($id);
        $deliveryArea->update($data);

        return $deliveryArea->fresh();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->findOrFail($id)->delete();
    }
}
