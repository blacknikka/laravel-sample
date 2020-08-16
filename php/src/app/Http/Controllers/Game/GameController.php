<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Models\Game\Play\GamePlayViewModel;
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
        $playResult = $this->gamePlayUseCaseInterface->play($token);

        $model = new GamePlayViewModel($playResult);
        return response()->json($model->toArray());
    }
}
