<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStudentRequest;
use App\Http\Resources\User\UserSimpleResource;
use App\Http\Resources\User\UsersStudentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminDeliberationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $users = User::query()->findSearchAndPaginated($request);

        return UsersStudentResource::collection($users);
    }

    public function show(int $id): UsersStudentResource
    {
        $user = User::query()->findByIdOrThrow($id);

        return new UsersStudentResource($user);
    }

    public function store(UserStudentRequest $request): UserSimpleResource
    {
        $user = DB::transaction(function () use ($request) {
            return User::create($request->validated());
        });

        return new UserSimpleResource($user);
    }

    public function update(UserStudentRequest $request, int $id): UserSimpleResource
    {
        $course = User::findOrFail($id);

        DB::transaction(function () use ($request, $course) {
            $course->update($request->validated());
        });

        return new UserSimpleResource($course);
    }

    public function destroy(int $id): bool|null
    {
        $user = User::findOrFail($id);

        return DB::transaction(fn(): bool|null => $user->delete());
    }
}
