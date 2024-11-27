<?php

namespace App\Http\Controllers;

use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected $areaService;

    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    public function index()
    {
        try {
            $areas = $this->areaService->getAllAreas();
            return response()->json([
                'message' => 'Areas retrieved successfully.',
                'data' => $areas,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve areas.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $area = $this->areaService->createArea($request->all());
            return response()->json([
                'message' => 'Area created successfully.',
                'data' => $area,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create area.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $area = $this->areaService->getAreaById($id);

            if (!$area) {
                return response()->json([
                    'message' => 'Area not found.',
                ], 404);
            }
            
            return response()->json([
                'message' => 'Area retrieved successfully.',
                'data' => $area,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve area.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $area = $this->areaService->updateArea($id, $request->all());

            if (!$area) {
                return response()->json([
                    'message' => 'Area not found.',
                ], 404);
            }

            return response()->json([
                'message' => 'Area updated successfully.',
                'data' => $area,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update area.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->areaService->deleteArea($id);

            if (!$deleted) {
                return response()->json([
                    'message' => 'Area not found.',
                ], 404);
            }

            return response()->json([
                'message' => 'Area deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete area.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}