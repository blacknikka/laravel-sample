<?php


namespace packages\Domain\Application\Game;

use packages\Domain\Domain\Account\AccountRepositoryInterface;
use packages\UseCase\Game\GamePlayUseCaseInterface;
use packages\Domain\Domain\User\UserRepositoryInterface;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\Play\GamePlayInterface;
use packages\Domain\Domain\Game\PlayResult\PlayResult;

class GamePlayInteractor implements GamePlayUseCaseInterface
{
    private $userRepositoryInterface;
    private $accountRepositoryInterface;
    private $gamePlayInterface;

    /**
     * create
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        AccountRepositoryInterface $accountRepositoryInterface,
        GamePlayInterface $gamePlayInterface
    )
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->accountRepositoryInterface = $accountRepositoryInterface;
        $this->gamePlayInterface = $gamePlayInterface;
    }

    /**
     * @param Token
     *
     * @return PlayResult
     */
    public function play(Token $token): PlayResult
    {
        // find a user from token.
        $user = $this->userRepositoryInterface->findByToken($token);

        // create game instance.
        $game = new Game(
            $this->gamePlayInterface,
            $user->getGame()->getState()
        );

        // update game state.
        $this->userRepositoryInterface
            ->updateGameState(
                $user->getId(),
                $game->getState()
        );

        // play
        $playData = $game->play();

        // add to account value.
        $account = $this->accountRepositoryInterface->find($user->getAccountId());
        $account->addBalance($playData->getScore());

        // update balance value.
        $this->accountRepositoryInterface
            ->updateBalance(
                $user->getAccountId(),
                $account->getBalance()
            );

        return new PlayResult($account, $playData);
    }
}
