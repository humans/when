<?php

namespace Humans\When;

use Stringable;

class When implements Stringable
{
    protected $subject;
    protected $truthyResponse;
    protected $falsyResponse;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function is($value)
    {
        $this->subject = ($this->subject === $value);

        return $this;
    }

    public function return($value)
    {
        $this->truthyResponse = $value;

        return $this;
    }

    public function else($value)
    {
        $this->falsyResponse = $value;

        return $this;
    }

    public function echo()
    {
        if (! $this->subject) {
            return $this->toString($this->falsyResponse);
        }

        return $this->toString($this->truthyResponse);
    }

    private function toString($value)
    {
        if (is_callable($value)) {
            return $value();
        }

        return $value;
    }

    public function __toString()
    {
        return (string) $this->echo();
    }

    public function __get($name)
    {
        return new self($this->subject->{$name});
    }

    public function __call($name, array $arguments = [])
    {
        return new self(
            call_user_func_array([$this->subject, $name], $arguments)
        );
    }
}
