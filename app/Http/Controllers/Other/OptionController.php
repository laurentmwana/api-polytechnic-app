<?php

namespace App\Http\Controllers\Other;

use App\Models\Option;
use App\Http\Controllers\Controller;
use App\Http\Resources\Option\OptionResource;
use App\Http\Resources\Option\OptionsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OptionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $options = Option::with(['levels', 'department'])
            ->orderByDesc('updated_at')
            ->paginate();

        return OptionsResource::collection($options);
    }

    public function show(int $id): OptionResource
    {
        $option = Option::with(['department', 'levels'])
            ->findOrFail($id);

        return new OptionResource($option);
    }
}
