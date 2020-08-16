<?php

namespace packages\Domain\Domain\User;

use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Game\Game;
use Illuminate\Support\Str;
use packages\Domain\Domain\Game\Play\GamePlay;
use packages\Domain\Domain\Token\TokenCreator;

class User
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * token
     *
     * @var Token
     */
    private $token;

    /**
     * Game information
     *
     * @var Game
     */
    private $game;

    /**
     * @var AccountId
     */
    private $accountId;

    /**
     * @param UserId $id
     * @param AccountId $accountId
     * @param Token $token
     * @param Game $game
     */
    public function __construct(UserId $id, AccountId $accountId = null, Token $token = null, Game $game = null)
    {
        $this->id = $id;

        // create an account
        if (is_null($accountId)) {
            $accountIdStr = Str::random(40);
            $this->accountId = new AccountId($accountIdStr);
        } else {
            $this->accountId = $accountId;
        }

        // create a token.
        if (is_null($token)) {
            $this->token = new Token(TokenCreator::createToken());
        } else {
            $this->token = $token;
        }

        // create a game state.
        if (is_null($game)) {
            $this->game = new Game(new GamePlay());
        } else {
            $this->game = $game;
        }
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return AccountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }
}
