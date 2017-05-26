<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Query\Specification;

use GpsLab\Component\Middleware\Middleware;

class SpecificationQueryMiddleware implements Middleware
{
    /**
     * @param mixed    $message
     * @param callable $next
     *
     * @return mixed
     */
    public function handle($message, callable $next)
    {
        if ($message instanceof SpecificationQuery && !($message instanceof ObviousSpecificationQuery)) {
            $message = new ObviousSpecificationQuery(
                $message->getEntity(),
                $message->getSpec(),
                $message->getModifier()
            );
        }

        return $next($message);
    }
}
