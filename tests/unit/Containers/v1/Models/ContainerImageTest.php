<?php

namespace OpenStack\Test\Containers\v1\Models;

use OpenStack\Containers\v1\Api;
use OpenStack\Containers\v1\Models\ContainerImage;
use OpenStack\Test\TestCase;

class ContainerImageTest extends TestCase
{
    private $containerImage;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootFixturesDir = dirname(__DIR__);

        $this->containerImage = new ContainerImage($this->client->reveal(), new Api());
    }

    public function test_it_populates_from_response()
    {
        $response = $this->getFixture('container-commit');

        $this->containerImage->populateFromResponse($response);

        self::assertEquals('64281d85-e9a3-4c54-8d30-9ee72a596d8a', $this->containerImage->uuid);
    }
}
