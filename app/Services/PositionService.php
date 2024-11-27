<?php

namespace App\Services;

use App\Models\Position;

class PositionService
{
    protected $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function getAllPositions()
    {
        return $this->position->all();
    }

    public function getPositionById($id)
    {
        return $this->position->find($id);
    }

    public function createPosition($params)
    {
        return $this->position->create($params);
    }

    public function updatePosition($id, $params)
    {
        $position = $this->getPositionById($id);
        if ($position) {
            $position->update($params);
            return $position;
        }
        return null;
    }

    public function deletePosition($id)
    {
        $position = $this->getPositionById($id);
        if ($position) {
            $position->delete();
            return true;
        }

        return false;
    }
}