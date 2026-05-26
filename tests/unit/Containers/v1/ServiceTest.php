<?php

namespace OpenStack\Test\Containers\v1;

use GuzzleHttp\Psr7\Response;
use OpenStack\Containers\v1\Api;
use OpenStack\Containers\v1\Models\Container;
use OpenStack\Containers\v1\Models\ContainerImage;
use OpenStack\Containers\v1\Service;
use OpenStack\Test\TestCase;

class ServiceTest extends TestCase
{
    /** @var Service */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootFixturesDir = __DIR__;

        $this->service = new Service($this->client->reveal(), new Api());
    }

    public function test_it_creates_a_container()
    {
        $opts = [
            'name'  => 'new-container',
            'image' => 'ubuntu',
        ];

        $this->mockRequest('POST', 'containers', 'container-post', $opts);

        $container = $this->service->createContainer($opts);

        self::assertEquals('new-uuid', $container->uuid);
        self::assertEquals('new-container', $container->name);
    }

    public function test_it_lists_containers()
    {
        $this->mockRequest('GET', 'containers', 'containers-get');

        $containers = $this->service->listContainers();

        $count = 0;
        foreach ($containers as $container) {
            self::assertInstanceOf(Container::class, $container);
            $count++;
        }

        self::assertEquals(2, $count);
    }

    public function test_it_gets_a_container()
    {
        $container = $this->service->getContainer('container-id');

        self::assertInstanceOf(Container::class, $container);
        self::assertEquals('container-id', $container->id);
    }

    public function test_it_kills_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/kill', new Response(204));

        $this->service->killContainer('container-id');
    }

    public function test_it_starts_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/start', new Response(204));

        $this->service->startContainer('container-id');
    }

    public function test_it_stops_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/stop', new Response(204));

        $this->service->stopContainer('container-id');
    }

    public function test_it_reboots_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/reboot', new Response(204));

        $this->service->rebootContainer('container-id');
    }

    public function test_it_rebuilds_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/rebuild', new Response(204));

        $this->service->rebuildContainer('container-id');
    }

    public function test_it_pauses_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/pause', new Response(204));

        $this->service->pauseContainer('container-id');
    }

    public function test_it_unpauses_a_container()
    {
        $this->mockRequest('POST', 'containers/container-id/unpause', new Response(204));

        $this->service->unpauseContainer('container-id');
    }

    public function test_it_gets_container_logs()
    {
        $response = new Response(200, [], 'container logs');
        $this->mockRequest('GET', 'containers/container-id/logs', $response);

        $logs = $this->service->getContainerLogs('container-id');

        self::assertEquals('container logs', $logs);
    }

    public function test_it_attaches_to_a_container()
    {
        $response = new Response(200, [], 'wss://websocket-url');
        $this->mockRequest('GET', 'containers/container-id/attach', $response);

        $url = $this->service->attachContainer('container-id');

        self::assertEquals('wss://websocket-url', $url);
    }

    public function test_it_resizes_a_container()
    {
        $this->mockRequest('POST', ['path' => 'containers/container-id/resize', 'query' => ['width' => '80', 'height' => '24']], new Response(200));

        $this->service->resizeContainer('container-id', ['width' => '80', 'height' => '24']);
    }

    public function test_it_commits_a_container()
    {
        $this->mockRequest('POST', ['path' => 'containers/container-id/commit', 'query' => ['repository' => 'myrepo', 'tag' => 'latest']], 'container-commit');

        $result = $this->service->commitContainer('container-id', ['repository' => 'myrepo', 'tag' => 'latest']);

        self::assertEquals('64281d85-e9a3-4c54-8d30-9ee72a596d8a', $result->uuid);
    }
}
