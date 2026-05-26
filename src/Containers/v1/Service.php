<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1;

use Generator;
use OpenStack\Common\Service\AbstractService;
use OpenStack\Containers\v1\Models\Container;
use OpenStack\Containers\v1\Models\ContainerImage;

/**
 * @property Api $api
 */
class Service extends AbstractService
{
    /**
     * Create a new container.
     *
     * @param array $options {@see Api::create}
     */
    public function createContainer(array $options): Container
    {
        return $this->model(Container::class)->create($options);
    }

    /**
     * List containers.
     *
     * @param array         $options {@see Api::list}
     * @param callable|null $mapFn   optional function to map over the results
     *
     * @return Generator<mixed, Container>
     */
    public function listContainers(array $options = [], ?callable $mapFn = null): Generator
    {
        return $this->model(Container::class)->enumerate($this->api->list(), $options, $mapFn);
    }

    /**
     * Get a container.
     *
     * @param string $id the container ID or UUID
     */
    public function getContainer(string $id): Container
    {
        $container     = $this->model(Container::class);
        $container->id = $id;

        return $container;
    }

    /**
     * Kill a container.
     *
     * @param string $id the container ID or UUID
     */
    public function killContainer(string $id): void
    {
        $this->getContainer($id)->kill();
    }

    /**
     * Start a container.
     *
     * @param string $id the container ID or UUID
     */
    public function startContainer(string $id): void
    {
        $this->getContainer($id)->start();
    }

    /**
     * Stop a container.
     *
     * @param string $id the container ID or UUID
     */
    public function stopContainer(string $id): void
    {
        $this->getContainer($id)->stop();
    }

    /**
     * Reboot a container.
     *
     * @param string $id the container ID or UUID
     */
    public function rebootContainer(string $id): void
    {
        $this->getContainer($id)->reboot();
    }

    /**
     * Rebuild a container.
     *
     * @param string $id the container ID or UUID
     */
    public function rebuildContainer(string $id): void
    {
        $this->getContainer($id)->rebuild();
    }

    /**
     * Pause a container.
     *
     * @param string $id the container ID or UUID
     */
    public function pauseContainer(string $id): void
    {
        $this->getContainer($id)->pause();
    }

    /**
     * Unpause a container.
     *
     * @param string $id the container ID or UUID
     */
    public function unpauseContainer(string $id): void
    {
        $this->getContainer($id)->unpause();
    }

    /**
     * Get container logs.
     *
     * @param string $id      the container ID or UUID
     * @param array  $options {@see Api::logs}
     */
    public function getContainerLogs(string $id, array $options = []): string
    {
        return $this->getContainer($id)->logs($options);
    }

    /**
     * Attach to a container.
     *
     * @param string $id the container ID or UUID
     *
     * @return string TTY websocket URL
     */
    public function attachContainer(string $id): string
    {
        return $this->getContainer($id)->attach();
    }

    /**
     * Resize tty of a container.
     *
     * @param string $id      the container ID or UUID
     * @param array  $options {@see Api::resize}
     */
    public function resizeContainer(string $id, array $options = []): void
    {
        $this->getContainer($id)->resize($options);
    }

    /**
     * Commit a container (make a snapshot into a new container image).
     *
     * @param string $id      the container ID or UUID
     * @param array  $options {@see Api::commit}
     *
     * @return ContainerImage Container Image with UUID of a snapshot
     */
    public function commitContainer(string $id, array $options = []): ContainerImage
    {
        return $this->getContainer($id)->commit($options);
    }
}
