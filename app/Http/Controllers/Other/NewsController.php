<?php

namespace App\Http\Controllers\Other;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsResource;
use App\Http\Resources\News\NewsCollectionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = $request->query->getInt('limit');

        $news = null !== $limit && $limit > 0
            ? News::query()->findLimit($limit)
            : News::query()->findSearchAndPaginated($request);

        return NewsCollectionResource::collection($news);
    }

    public function show(int $id): NewsResource
    {
        $news = News::query()->findByIdOrThrow($id);

        return new NewsResource($news);
    }
}
