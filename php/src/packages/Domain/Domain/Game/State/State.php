<?php

namespace packages\Domain\Domain\Game\State;

use InvalidArgumentException;
use packages\Domain\Domain\Game\State\StateStatics;

class State
{
    // しきい値
    const STATE_MAX_COUNT = 5;

    /**
     * state
     *
     * @var string
     */
    private $state;
    private $counter;

    /**
     * Random
     */
    public function __construct(string $state = StateStatics::STATE_INIT)
    {
        if (!StateStatics::isValid($state)) {
            throw new InvalidArgumentException("state is not valid");
        }

        $this->state = $state;
        $this->counter = 0;
    }

    /**
     * Check if the state is same.
     *
     * @return bool
     */
    public function isState(string $state): bool
    {
        return $this->state === $state;
    }

    /**
     * play and transit state.
     *
     * @return void
     */
    public function PlayAndTransitState(): void
    {
        $this->counter++;
        if ($this->counter >= self::STATE_MAX_COUNT) {
            $this->counter = 0;

            // 状態をトグル
            $this->state = $this->state === StateStatics::STATE_INIT ? StateStatics::STATE_ANOTHER : StateStatics::STATE_INIT;
        }
    }
}
