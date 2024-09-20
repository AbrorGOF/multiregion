<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\CreateDistrictRequest;
use App\Models\District;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
    public function create(CreateDistrictRequest $request): JsonResponse
    {
        $district = District::create([
            'name' => $request->validated('name'),
            'code' => Str::upper($request->validated('name')),
            'country_id' => $request->validated('country_id', 1),
            'region_id' => $request->validated('region_id', 1),
        ]);
        return response()->json([
            'message' => 'District created successfully',
            'district' => $district->only(['id', 'name', 'code'])
        ]);
    }

    public function delete(District $district): JsonResponse
    {
        $district->update(['is_active' => IsActiveEnum::BLOCK]);
        return response()->json([
            'message' => 'District deleted successfully',
        ]);
    }

    public function list(): JsonResponse
    {
        return response()->json(
            District::active()
                ->select(['id', 'name', 'code'])
                ->paginate(10)
        );
    }
}
