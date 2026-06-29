<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1\Models;

use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Containers\v1\Api;

/**
 * @property Api $api
 */
class ContainerExecuteResult extends OperatorResource
{
    /** @var string|null */
    public $execId;

    /** @var string|null */
    public $output;

    /** @var int|null */
    public $exitCode;

    /** @var string|null */
    public $url;

    protected $aliases = [
        'exec_id'   => 'execId',
        'exit_code' => 'exitCode',
    ];

    protected $resourceKey  = 'containerExecuteResult';
    protected $resourcesKey = 'containerExecuteResults';
    protected $markerKey    = 'exec_id';

    public function resize(array $options): string
    {
        $options['exec_id'] = $this->execId;
        $response           = $this->execute($this->api->executeResize(), $options);

        return (string) $response->getBody();
    }
}
