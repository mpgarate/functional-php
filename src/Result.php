<?php
declare(strict_types=1);

namespace FPHP;

abstract class Result {
    public static function error(string $message, Error $cause = null): Result {
        return new Error($message, $cause);
    }

    public static function ok($value): Result {
        return new Ok($value);
    }

    abstract public function isOk(): bool;

    abstract public function isError(): bool;
}

class Error extends Result {
    private $message;
    private $cause;

    function __construct(string $message, Error $cause = null) {
        $this->message = $message;
        $this->cause = $cause;
    }

    public function isOk(): bool {
        return false;
    }

    public function isError(): bool {
        return true;
    }
}

class Ok extends Result {
    private $val;

    function __construct($val) {
        $this->val = $val;
    }

    public function isOk(): bool {
        return true;
    }

    public function isError(): bool {
        return false;
    }
}
