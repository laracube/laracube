<?php

namespace Laracube\Laracube\Traits;

trait AuthorizedToSee
{
    /**
     * Determine if the report or resource should be available for the given request.
     *
     * @return bool
     */
    public function canSee()
    {
        return true;
    }
}
