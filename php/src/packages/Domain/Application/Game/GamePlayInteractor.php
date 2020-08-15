<?php


namespace packages\Domain\Application\Game;

use packages\UseCase\Game\GamePlayUseCaseInterface;
use packages\Domain\Domain\User\UserRepositoryInterface;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\PlayData\PlayData;


class GamePlayInteractor implements GamePlayUseCaseInterface
{
    private $userRepositoryInterface;

    /**
     * create
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * @param Token
     *
     * @return PlayData
     */
    public function play(Token $token): PlayData
    {
        // find a user from token.
        $user = $this->userRepositoryInterface->findByToken($token);

        // create game instance.
        $game = new Game($user->getGame()->getState());

        // update game state.
        $this->userRepositoryInterface
            ->updateGameState(
                $user->getId(),
                $game->getState()
        );

        // play
        return $game->play();
    }
}
