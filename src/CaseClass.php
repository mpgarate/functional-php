<?php
declare(strict_types=1);

namespace FPHP;

class NoSuchPropertyException extends \Exception {}

trait CaseClass {
    private $data;

    public function destructure(): array {
        return array_values($this->data);
    }

    /**
     * @throws NoSuchPropertyException
     */
    public function __call($name, $args) {
        return Opt::from($this->data[$name] ?? null) 
            ->unwrapOrElse(function() use ($name) {
                throw new NoSuchPropertyException("no property $name for this case class");
            });
    }
}