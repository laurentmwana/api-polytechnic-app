<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Http\Resources\Option\OptionResource;
use App\Http\Resources\Option\OptionsResource;
use App\Http\Resources\Option\OptionSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminOptionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $options = Option::query()->findSearchAndPaginated($request);

        return OptionsResource::collection($options);
    }

    public function store(OptionRequest $request): OptionSimpleResource
    {
        $option = DB::transaction(function () use ($request) {
            return Option::create($request->validated());
        });

        return new OptionSimpleResource($option);
    }

    public function show(int $id): OptionResource
    {
        $option = Option::query()->findByIdOrThrow($id);

        return new OptionResource($option);
    }

    public function update(OptionRequest $request, int $id): OptionSimpleResource
    {
        $option = Option::findOrFail($id, ['name', 'id']);

        DB::transaction(function () use ($request, $option) {
            $option->update($request->validated());
        });

        return new OptionSimpleResource($option);
    }

    public function destroy(int $id): bool|null
    {
        $option = Option::findOrFail($id);

        return DB::transaction(fn(): bool|null => $option->delete());
    }
}
