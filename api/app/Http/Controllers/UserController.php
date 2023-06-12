<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use src\Application\Service\CreateUser;


class UserController extends Controller
{
    private $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->createUser->execute($name, $email, $password);

        return response()->json($user->toArray(), 201);
    }
}
