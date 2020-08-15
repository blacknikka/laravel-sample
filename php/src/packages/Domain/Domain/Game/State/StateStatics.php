<?php

namespace packages\Domain\Domain\Game\State;

class StateStatics
{
    // 初期状態
    public const STATE_INIT = "stateX";
    // 状態２
    public const STATE_ANOTHER = "stateAnother";

    /**
     * check if the state is valid.
     *
     * @param string $state
     * @return boolean
     */
    static public function isValid(string $state): bool
    {
        return $state === self::STATE_INIT || $state === self::STATE_ANOTHER;
    }
}
