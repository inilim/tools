<?php

namespace Illuminate\Support {
    class Stringable implements \Stringable
    {
        /**
         * The underlying string value.
         *
         * @var string
         */
        protected $value;

        /**
         * Create a new instance of the class.
         *
         * @param  string  $value
         */
        function __construct($value = '')
        {
            $this->value = (string) $value;
        }

        /**
         * Apply the callback if the given "value" is (or resolves to) falsy.
         *
         * @template TUnlessParameter
         * @template TUnlessReturnType
         *
         * @param  (\Closure($this): TUnlessParameter)|TUnlessParameter|null  $value
         * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $callback
         * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $default
         * @return $this|TUnlessReturnType
         */
        function unless($value = null, ?callable $callback = null, ?callable $default = null)
        {
            $value = $value instanceof \Closure ? $value($this) : $value;

            if (func_num_args() === 0) {
                return $this->getHigherOrderWhenProxy($this)->negateConditionOnCapture();
            }

            if (func_num_args() === 1) {
                return $this->getHigherOrderWhenProxy($this)->condition(!$value);
            }

            if (!$value) {
                return $callback($this, $value) ?? $this;
            } elseif ($default) {
                return $default($this, $value) ?? $this;
            }

            return $this;
        }

        /**
         * Append the given values to the string.
         * @param  string[]|string  ...$values
         * @return static
         */
        function append(...$values)
        {
            return new static($this->value . \implode('', $values));
        }

        protected function getHigherOrderWhenProxy($value)
        {
            return new class($value) {
                /**
                 * The target being conditionally operated on.
                 *
                 * @var Stringable
                 */
                protected $target;

                /**
                 * The condition for proxying.
                 *
                 * @var bool
                 */
                protected $condition;

                /**
                 * Indicates whether the proxy has a condition.
                 *
                 * @var bool
                 */
                protected $hasCondition = false;

                /**
                 * Determine whether the condition should be negated.
                 *
                 * @var bool
                 */
                protected $negateConditionOnCapture;

                /**
                 * Create a new proxy instance.
                 *
                 * @param  mixed  $target
                 */
                function __construct($target)
                {
                    $this->target = $target;
                }

                /**
                 * Set the condition on the proxy.
                 *
                 * @param  bool  $condition
                 * @return $this
                 */
                function condition($condition)
                {
                    [$this->condition, $this->hasCondition] = [$condition, true];

                    return $this;
                }

                /**
                 * Indicate that the condition should be negated.
                 *
                 * @return $this
                 */
                function negateConditionOnCapture()
                {
                    $this->negateConditionOnCapture = true;

                    return $this;
                }
            };
        }

        /**
         * Get the raw string value.
         *
         * @return string
         */
        function __toString()
        {
            return (string) $this->value;
        }
    }
}
