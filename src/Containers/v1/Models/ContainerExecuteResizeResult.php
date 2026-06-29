<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1\Models;

use OpenStack\Common\Resource\OperatorResource;

class ContainerExecuteResizeResult extends OperatorResource
{
    /** @var string|null */
    public $execId;

    /** @var string|null */
    public $url;

    protected $aliases = [
        'exec_id' => 'execId',
    ];

    protected $resourceKey  = 'containerExecuteResizeResult';
    protected $resourcesKey = 'containerExecuteResizeResults';
    protected $markerKey    = 'exec_id';
}
