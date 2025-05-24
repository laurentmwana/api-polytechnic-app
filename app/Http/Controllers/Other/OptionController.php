<?php

namespace App\Http\Controllers\Other;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Option\OptionResource;
use App\Http\Resources\Option\OptionsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OptionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = $request->query->get('limit');

        $options = null !== $limit && !empty($limit)
            ? Option::query()->findLimit($limit)
            : Option::query()->findSearchAndPaginated($request);

        return OptionsResource::collection($options);
    }

    public function show(int $id): OptionResource
    {
        $option = Option::query()->findByIdOrThrow($id);

        return new OptionResource($option);
    }
}
