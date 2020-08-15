<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use packages\UseCase\Game\GamePlayUseCaseInterface;
use packages\Domain\Domain\Token\Token;
use App\Http\Requests\PlayGameRequest;

class GameController extends Controller
{
    private $gamePlayUseCaseInterface;

    public function __construct(GamePlayUseCaseInterface $gamePlayUseCaseInterface)
    {
        $this->gamePlayUseCaseInterface = $gamePlayUseCaseInterface;
    }

    public function Play(PlayGameRequest $request)
    {
        // play from token.
        $token = new Token($request->token);
        $playData = $this->gamePlayUseCaseInterface->play($token);

        return json_encode([]);
    }
}
