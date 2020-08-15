<?php


namespace App\Http\Models\User\Game;

use packages\Domain\Domain\Game\State\State;


class UserGameViewMode
{
    /**
     * @var string
     */
    private $state;

    /**
     * @var int
     */
    private $counter;

    public function __construct(State $state)
    {
        $this->state = $state->getState();
        $this->counter = $state->getCounter();
    }

    public function toArray(): array
    {
        return [
            'state' => $this->state,
            'counter' => $this->counter,
        ];
    }
}
