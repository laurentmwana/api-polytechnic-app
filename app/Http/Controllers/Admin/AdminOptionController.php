<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Http\Resources\Option\OptionResource;
use App\Http\Resources\Option\OptionsResource;
use App\Http\Resources\Option\OptionUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminOptionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $options = Option::with(['levels', 'department'])
            ->orderByDesc('updated_at')
            ->paginate();

        return OptionsResource::collection($options);
    }

    public function store(OptionRequest $request): OptionUpdateResource
    {
        $option = DB::transaction(function () use ($request) {
            return Option::create($request->validated());
        });

        return new OptionUpdateResource($option);
    }

    public function show(int $id): OptionResource
    {
        $option = Option::with(['department', 'levels'])
            ->findOrFail($id);

        return new OptionResource($option);
    }

    public function update(OptionRequest $request, int $id): OptionUpdateResource
    {
        $option = Option::findOrFail($id, ['name', 'id']);

        DB::transaction(function () use ($request, $option) {
            $option->update($request->validated());
        });

        return new OptionUpdateResource($option);
    }

    public function destroy(int $id): bool|null
    {
        $option = Option::findOrFail($id);

        return DB::transaction(fn(): bool|null => $option->delete());
    }
}
