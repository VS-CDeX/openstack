<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1;

use OpenStack\Common\Api\AbstractApi;

/**
 * A representation of the Containers Zun v1 REST API.
 *
 * @internal
 */
class Api extends AbstractApi
{
    public function __construct()
    {
        $this->params = new Params();
    }

    public function create(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers',
            'params' => $this->params->container(),
        ];
    }

    public function list(): array
    {
        return [
            'method' => 'GET',
            'path'   => 'containers',
            'params' => [
                'name'       => $this->params->name(),
                'image'      => $this->params->image(),
                'projectId'  => $this->params->projectId(),
                'userId'     => $this->params->userId(),
                'memory'     => $this->params->memory(),
                'host'       => $this->params->host(),
                'taskState'  => $this->params->taskState(),
                'status'     => $this->params->status(),
                'autoRemove' => $this->params->autoRemove(),
            ],
        ];
    }

    public function details(): array
    {
        return [
            'method' => 'GET',
            'path'   => 'containers/{id}',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function delete(): array
    {
        return [
            'method' => 'DELETE',
            'path'   => 'containers/{id}',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function kill(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/kill',
            'params' => [
                'id'     => $this->params->idPath(),
                'signal' => $this->params->signal(),
            ],
        ];
    }

    public function start(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/start',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function stop(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/stop',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function pause(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/pause',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function unpause(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/unpause',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function rebuild(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/rebuild',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function reboot(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/reboot',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function logs(): array
    {
        return [
            'method' => 'GET',
            'path'   => 'containers/{id}/logs',
            'params' => [
                'id'         => $this->params->idPath(),
                'stdout'     => $this->params->stdout(),
                'stderr'     => $this->params->stderr(),
                'timestamps' => $this->params->timestamps(),
                'tail'       => $this->params->tail(),
                'since'      => $this->params->since(),
            ],
        ];
    }

    public function attach(): array
    {
        return [
            'method' => 'GET',
            'path'   => 'containers/{id}/attach',
            'params' => [
                'id' => $this->params->idPath(),
            ],
        ];
    }

    public function resize(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/resize',
            'params' => [
                'id'     => $this->params->idPath(),
                'width'  => $this->params->ttyWidth(),
                'height' => $this->params->ttyHeight(),
            ],
        ];
    }

    public function commit(): array
    {
        return [
            'method' => 'POST',
            'path'   => 'containers/{id}/commit',
            'params' => [
                'id'         => $this->params->idPath(),
                'repository' => $this->params->repository(),
                'tag'        => $this->params->tag(),
            ],
        ];
    }
}
