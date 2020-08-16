<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use packages\UseCase\User\UserCreateUseCaseInterface;
use App\Http\Models\User\Create\UserCreateViewModel;
use App\Http\Models\User\Game\UserGameViewMode;

class UserController extends Controller
{
    private $userCreateUseCaseInterface;

    public function __construct(UserCreateUseCaseInterface $userCreateUseCaseInterface)
    {
        $this->userCreateUseCaseInterface = $userCreateUseCaseInterface;
    }

    public function CreateUserAndAccount()
    {
        // cerate user
        $user = $this->userCreateUseCaseInterface->createUser();

        // create view model
        $viewModel = new UserCreateViewModel(
            $user->getToken()->getToken(),
            new UserGameViewMode(
                $user->getGame()->getState()
            )
        );

        return response()->json($viewModel->toArray());
    }
}
