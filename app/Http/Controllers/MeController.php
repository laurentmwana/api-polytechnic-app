<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserMeResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request): UserMeResource
    {
        return new UserMeResource($request->user());
    }
}
