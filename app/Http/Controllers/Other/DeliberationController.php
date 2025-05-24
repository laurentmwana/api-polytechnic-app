<?php

namespace App\Http\Controllers\Other;

use App\Models\Deliberation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Deliberation\DeliberationResource;
use App\Http\Resources\Deliberation\DeliberationsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DeliberationController  extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = $request->query->getInt('limit');

        $deliberations = null !== $limit && $limit > 0
            ? Deliberation::query()->findLimit($limit)
            : Deliberation::query()->findSearchAndPaginated($request);

        return DeliberationsResource::collection($deliberations);
    }

    public function show(int $id): DeliberationResource
    {
        $deliberation = Deliberation::query()->findByIdOrThrow($id);

        return new DeliberationResource($deliberation);
    }
}
