<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1\Models;

use OpenStack\Common\Resource\OperatorResource;

class ContainerImage extends OperatorResource
{
    /** @var string */
    public $uuid;

    protected $resourceKey  = 'containerImage';
    protected $resourcesKey = 'containerImages';
    protected $markerKey    = 'uuid';
}
