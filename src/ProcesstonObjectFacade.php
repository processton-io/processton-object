<?php

namespace Processton\ProcesstonObject;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Processton\ProcesstonObject\Skeleton\SkeletonClass
 */
class ProcesstonObjectFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'processton-object';
    }
}
