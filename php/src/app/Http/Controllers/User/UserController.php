<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use packages\Domain\Application\User\UserCreateInteractor;
use App\Http\Models\User\Create\UserCreateViewModel;
use App\Http\Models\User\Game\UserGameViewMode;

class UserController extends Controller
{
    private $userCreateInteractor;

    public function __construct(UserCreateInteractor $userCreateInteractor)
    {
        $this->userCreateInteractor = $userCreateInteractor;
    }

    public function CreateUserAndAccount()
    {
        // cerate user
        $user = $this->userCreateInteractor->createUser();

        // create view model
        $viewModel = new UserCreateViewModel(
            $user->getToken()->getToken(),
            new UserGameViewMode(
                $user->getGame()->getState()
            )
        );

        return json_encode($viewModel->toArray());
    }
}
