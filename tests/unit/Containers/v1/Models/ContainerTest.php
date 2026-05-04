<?php

namespace OpenStack\Test\Containers\v1\Models;

use GuzzleHttp\Psr7\Response;
use OpenStack\Containers\v1\Api;
use OpenStack\Containers\v1\Models\Container;
use OpenStack\Containers\v1\Models\ContainerImage;
use OpenStack\Test\TestCase;

class ContainerTest extends TestCase
{
    private $container;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootFixturesDir = dirname(__DIR__);

        $this->container = new Container($this->client->reveal(), new Api());
        $this->container->id = 'container-id';
    }

    public function test_it_deletes()
    {
        $this->mockRequest('DELETE', 'containers/container-id', new Response(204));
        $this->container->delete();
    }

    public function test_it_starts()
    {
        $this->mockRequest('POST', 'containers/container-id/start', new Response(204));
        $this->container->start();
    }

    public function test_it_stops()
    {
        $this->mockRequest('POST', 'containers/container-id/stop', new Response(204));
        $this->container->stop();
    }

    public function test_it_reboots()
    {
        $this->mockRequest('POST', 'containers/container-id/reboot', new Response(204));
        $this->container->reboot();
    }

    public function test_it_rebuilds()
    {
        $this->mockRequest('POST', 'containers/container-id/rebuild', new Response(204));
        $this->container->rebuild();
    }

    public function test_it_pauses()
    {
        $this->mockRequest('POST', 'containers/container-id/pause', new Response(204));
        $this->container->pause();
    }

    public function test_it_unpauses()
    {
        $this->mockRequest('POST', 'containers/container-id/unpause', new Response(204));
        $this->container->unpause();
    }

    public function test_it_kills()
    {
        $this->mockRequest('POST', 'containers/container-id/kill', new Response(204));
        $this->container->kill();
    }

    public function test_it_gets_logs()
    {
        $response = new Response(200, [], 'container logs');
        $this->mockRequest('GET', 'containers/container-id/logs', $response);

        $logs = $this->container->logs();

        self::assertEquals('container logs', $logs);
    }

    public function test_it_attaches()
    {
        $response = new Response(200, [], 'wss://websocket-url');
        $this->mockRequest('GET', 'containers/container-id/attach', $response);

        $url = $this->container->attach();

        self::assertEquals('wss://websocket-url', $url);
    }

    public function test_it_resizes()
    {
        $this->mockRequest('POST', ['path' => 'containers/container-id/resize', 'query' => ['width' => '80', 'height' => '24']], new Response(200));

        $this->container->resize(['width' => '80', 'height' => '24']);
    }

    public function test_it_commits()
    {
        $this->mockRequest('POST', ['path' => 'containers/container-id/commit', 'query' => ['repository' => 'myrepo', 'tag' => 'latest']], 'container-commit');

        $result = $this->container->commit(['repository' => 'myrepo', 'tag' => 'latest']);

        self::assertInstanceOf(ContainerImage::class, $result);
        self::assertEquals('64281d85-e9a3-4c54-8d30-9ee72a596d8a', $result->uuid);
    }
}
