<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResturantCreateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\Restaurant;

class RestaurantsApiController extends Controller
{
	public function index()
	{
		$users = Restaurant::all();
		return $users;
	}

	public function store(ResturantCreateRequest $request)
	{
		return User::create($request->all());
	}

	public function update(UpdateUserRequest $request, User $user)
	{
		return $user->update($request->all());
	}

	public function show(Restaurant $r)
	{
		return $r;
	}

	public function destroy(Restaurant $r)
	{
		return $r->delete();
	}
}
