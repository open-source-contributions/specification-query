<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Query\Specification\Handler;

use Doctrine\ORM\EntityManagerInterface;
use GpsLab\Component\Query\Specification\SpecificationQuery;
use Happyr\DoctrineSpecification\EntitySpecificationRepositoryInterface;
use GpsLab\Component\Query\Handler\QueryHandler;
use GpsLab\Component\Query\Query;

class SpecificationQueryHandler implements QueryHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Query $query
     *
     * @return mixed
     */
    public function handle(Query $query)
    {
        if (!($query instanceof SpecificationQuery)) {
            return null;
        }

        /* @var $rep EntitySpecificationRepositoryInterface */
        $rep = $this->em->getRepository($query->getEntity());

        return $rep->match($query->getSpec(), $query->getModifier());
    }
}
