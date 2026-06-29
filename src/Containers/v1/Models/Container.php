<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1\Models;

use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Common\Resource\Retrievable;
use OpenStack\Containers\v1\Api;

/**
 * @property Api $api
 */
class Container extends OperatorResource implements Creatable, Listable, Retrievable, Deletable
{
    /** @var string */
    public $id;

    /** @var string */
    public $uuid;

    /** @var string */
    public $name;

    /** @var string */
    public $image;

    /** @var array */
    public $links;

    /** @var string */
    public $status;

    /** @var string */
    public $taskState;

    /** @var string */
    public $userId;

    /** @var string */
    public $projectId;

    /** @var string */
    public $command;

    /** @var float */
    public $cpu;

    /** @var string */
    public $memory;

    /** @var string */
    public $environment;

    /** @var string */
    public $workdir;

    /** @var bool */
    public $interactive;

    /** @var string */
    public $imagePullPolicy;

    /** @var array */
    public $securityGroups;

    /** @var bool */
    public $autoRemove;

    /** @var string */
    public $runtime;

    /** @var string */
    public $hostname;

    /** @var string */
    public $cpuPolicy;

    /** @var string */
    public $statusReason;

    /** @var array */
    public $ports;

    /** @var array */
    public $labels;

    /** @var array */
    public $addresses;

    /** @var array */
    public $restartPolicy;

    /** @var string */
    public $statusDetail;

    /** @var bool */
    public $tty;

    /** @var string */
    public $imageDriver;

    /** @var int */
    public $disk;

    /** @var bool */
    public $autoHeal;

    /** @var array */
    public $healthcheck;

    /** @var string */
    public $registryId;

    /** @var array */
    public $entrypoint;

    /** @var string */
    public $createdAt;

    /** @var string */
    public $updatedAt;

    protected $resourceKey  = 'container';
    protected $resourcesKey = 'containers';
    protected $markerKey    = 'uuid';

    protected $aliases = [
        'project_id'      => 'projectId',
        'user_id'         => 'userId',
        'cpu_policy'      => 'cpuPolicy',
        'status_reason'   => 'statusReason',
        'restart_policy'  => 'restartPolicy',
        'status_detail'   => 'statusDetail',
        'image_driver'    => 'imageDriver',
        'auto_heal'       => 'autoHeal',
        'registry_id'     => 'registryId',
        'created_at'      => 'createdAt',
        'updated_at'      => 'updatedAt',
        'task_state'      => 'taskState',
        'auto_remove'     => 'autoRemove',
        'security_groups' => 'securityGroups',
    ];

    /**
     * {@inheritDoc}
     */
    public function create(array $userOptions): self
    {
        $response = $this->execute($this->api->create(), $userOptions);

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve(): void
    {
        $response = $this->executeWithState($this->api->details());
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(): void
    {
        $this->executeWithState($this->api->delete());
    }

    public function start(): void
    {
        $this->executeWithState($this->api->start());
    }

    public function stop(): void
    {
        $this->executeWithState($this->api->stop());
    }

    public function reboot(): void
    {
        $this->executeWithState($this->api->reboot());
    }

    public function rebuild(): void
    {
        $this->executeWithState($this->api->rebuild());
    }

    public function pause(): void
    {
        $this->executeWithState($this->api->pause());
    }

    public function unpause(): void
    {
        $this->executeWithState($this->api->unpause());
    }

    public function kill(): void
    {
        $this->executeWithState($this->api->kill());
    }

    public function logs(array $options = []): string
    {
        $options['id'] = $this->id;
        $response      = $this->execute($this->api->logs(), $options);

        return (string) $response->getBody();
    }

    public function attach(): string
    {
        $response = $this->executeWithState($this->api->attach());

        return (string) $response->getBody();
    }

    public function resize(array $options = []): void
    {
        $options['id'] = $this->id;
        $this->execute($this->api->resize(), $options);
    }

    public function executeCommand(array $options = []): ContainerExecuteResult
    {
        $options['id'] = $this->id;
        $response      = $this->execute($this->api->execute(), $options);

        return $this->model(ContainerExecuteResult::class)->populateFromResponse($response);
    }

    public function executeResize(array $options = []): ContainerExecuteResizeResult
    {
        $options['id'] = $this->id;
        $response      = $this->execute($this->api->executeResize(), $options);

        return $this->model(ContainerExecuteResizeResult::class)->populateFromResponse($response);
    }

    public function commit(array $options = []): ContainerImage
    {
        $options['id'] = $this->id;
        $response      = $this->execute($this->api->commit(), $options);

        return $this->model(ContainerImage::class)->populateFromResponse($response);
    }
}
