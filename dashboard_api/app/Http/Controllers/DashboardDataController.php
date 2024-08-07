<?php

namespace App\Http\Controllers;

use App\Models\DashboardData;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardDataController extends Controller
{
    public function index()
    {
        try {
            $data = DashboardData::all();
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function show($id)
    {
        try {
            $data = DashboardData::find($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_type' => 'required|string|max:255',
            'data_value' => 'nullable|string',
        ]);

        try {
            $data = DashboardData::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'data_type' => 'sometimes|required|string|max:255',
            'data_value' => 'nullable|string',
        ]);

        try {
            $data = DashboardData::find($id);
            if ($data) {
                $data->update($request->all());
            }
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        try {
            $deleted = DashboardData::destroy($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $deleted,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }
}
