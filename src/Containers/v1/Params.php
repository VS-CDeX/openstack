<?php

declare(strict_types=1);

namespace OpenStack\Containers\v1;

use OpenStack\Common\Api\AbstractParams;

class Params extends AbstractParams
{
    public function container(): array
    {
        return [
            'name' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The name of the container.',
            ],
            'image' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The name or ID of the image.',
            ],
            'command' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'Send command to the container.',
            ],
            'cpu' => [
                'type'        => self::FLOAT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The number of virtual cpus.',
            ],
            'memory' => [
                'type'        => self::INT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The container memory size in MiB.',
            ],
            'workdir' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'workdir',
                'required'    => false,
                'description' => 'The working directory for commands to run in.',
            ],
            'labels' => [
                'type'        => self::OBJECT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'Adds a map of labels to a container.',
            ],
            'environment' => [
                'type'        => self::OBJECT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The environment variables to set in the container.',
            ],
            'restartPolicy' => [
                'type'        => self::OBJECT_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'restart_policy',
                'required'    => false,
                'description' => 'Restart policy to apply when a container exits. It must contain a Name key and its allowed values are no, on-failure, always, unless-stopped. Optionally, it can contain a MaximumRetryCount key and its value is an integer.',
                'properties'  => $this->restartPolicy(),
            ],
            'interactive' => [
                'type'        => self::BOOL_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'Keep STDIN open even if not attached.',
            ],
            'tty' => [
                'type'        => self::BOOL_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'Whether this container should allocate a TTY for itself.',
            ],
            'imageDriver' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'image_driver',
                'required'    => false,
                'description' => 'The image driver to use to pull container image. Allowed values are docker to pull the image from Docker Hub and glance to pull the image from Glance.',
                'enum'        => ['docker', 'glance'],
            ],
            'securityGroups' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'security_groups',
                'required'    => false,
                'description' => 'Security groups to be added to the container.',
            ],
            'nets' => [
                'type'        => self::ARRAY_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'A list of networks for the container.',
            ],
            'runtime' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The container runtime tool to create container with. You can use the default runtime that is runc or any other runtime configured to use with Docker.',
            ],
            'hostname' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The hostname of container.',
            ],
            'autoRemove' => [
                'type'        => self::BOOL_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'auto_remove',
                'required'    => false,
                'description' => 'enable auto-removal of the container on daemon side when the container’s process exits.',
            ],
            'autoHeal' => [
                'type'        => self::BOOL_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'auto_heal',
                'required'    => false,
                'description' => 'The flag of healing non-existent container in docker.',
            ],
            'availabilityZone' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'availability_zone',
                'required'    => false,
                'description' => 'The availability zone from which to run the container.',
            ],
            'hints' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The dictionary of data to send to the scheduler.',
            ],
            'mounts' => [
                'type'        => self::ARRAY_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'A list of dictionary data to specify how volumes are mounted into the container.',
                'items'       => $this->mount(),
            ],
            'privileged' => [
                'type'        => self::BOOL_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'Give extended privileges to the container.',
            ],
            'healthcheck' => [
                'type'        => self::OBJECT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'A dict of health check for the container.',
                'properties'  => $this->healthcheck(),
            ],
            'exposedPorts' => [
                'type'        => self::ARRAY_TYPE,
                'location'    => self::JSON,
                'sentAs'      => 'exposed_ports',
                'required'    => false,
                'description' => 'A list of dictionary data to specify how to expose container’s ports.',
                'items'       => ['type' => self::STRING_TYPE],
            ],
            'host' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The name of the host on which the container is to be created.',
            ],
            'entrypoint' => [
                'type'        => self::ARRAY_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The entrypoint which overwrites the default ENTRYPOINT of the image.',
                'items'       => ['type' => self::STRING_TYPE],
            ],
        ];
    }

    public function restartPolicy(): array
    {
        return [
            'name' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The name of the restart policy.',
                'enum'        => ['no', 'on-failure', 'always', 'unless-stopped'],
            ],
            'maximumRetryCount' => [
                'type' => self::INT_TYPE,
            ],
        ];
    }

    public function mount(): array
    {
        return [
            'type' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The type of mount.',
                'enum'        => ['bind', 'volume'],
            ],
            'source' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The source of the mount.',
            ],
            'size' => [
                'type'        => self::INT_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => "The size of the dynamic mount's volume.",
            ],
            'destination' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => false,
                'description' => 'The destination of the mount for the "bind" type.',
            ],
        ];
    }

    public function healthcheck(): array
    {
        return [
            'cmd' => [
                'type'        => self::STRING_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The command to run to check the health of the container.',
            ],
            'interval' => [
                'type'        => self::INT_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The interval to check the health of the container.',
            ],
            'retries' => [
                'type'        => self::INT_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The number of retries to check the health of the container.',
            ],
            'timeout' => [
                'type'        => self::INT_TYPE,
                'location'    => self::JSON,
                'required'    => true,
                'description' => 'The timeout to check the health of the container.',
            ],
        ];
    }

    /**
     * @param string|null $resource Not used
     */
    public function name(?string $resource = null): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Filters the response by name.',
        ];
    }

    public function image(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Filters the response by image.',
        ];
    }

    public function projectId(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'sentAs'      => 'project_id',
            'required'    => false,
            'description' => 'Filters the response by the ID of the project.',
        ];
    }

    public function userId(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'sentAs'      => 'user_id',
            'required'    => false,
            'description' => 'Filters the response by user ID.',
        ];
    }

    public function memory(): array
    {
        return [
            'type'        => self::INT_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Filters the response by memory size in Mib.',
        ];
    }

    public function host(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Filters the response by a host name, as a string.',
        ];
    }

    public function taskState(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'sentAs'      => 'task_state',
            'required'    => false,
            'description' => 'Filters the response by task state.',
        ];
    }

    public function status(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Filters the response by the current state of the container.',
        ];
    }

    public function autoRemove(): array
    {
        return [
            'type'        => self::BOOL_TYPE,
            'location'    => self::QUERY,
            'sentAs'      => 'auto_remove',
            'required'    => false,
            'description' => 'Filters the response according to whether they are auto-removed on exiting.',
        ];
    }

    public function signal(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Sends a signal to the container.',
        ];
    }

    public function since(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Show logs since a given datetime or integer epoch (in seconds).',
        ];
    }

    public function stdout(): array
    {
        return [
            'type'        => self::BOOL_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Only stdout logs of container.',
        ];
    }

    public function stderr(): array
    {
        return [
            'type'        => self::BOOL_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Only stderr logs of container.',
        ];
    }

    public function timestamps(): array
    {
        return [
            'type'        => self::BOOL_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Show timestamps.',
        ];
    }

    public function tail(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Number of lines to show from the end of the logs.',
        ];
    }

    public function ttyWidth(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The tty width of a container.',
        ];
    }

    public function ttyHeight(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The tty height of a container.',
        ];
    }

    public function repository(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The repository of the container image.',
        ];
    }

    public function tag(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The tag of the container image.',
        ];
    }

    public function command(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The command of the container.',
        ];
    }

    public function run(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'enum'        => ['True', 'true', 'False', 'false'],
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Run the command in the container right away.',
        ];
    }

    public function interactive(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'enum'        => ['True', 'true', 'False', 'false'],
            'location'    => self::QUERY,
            'required'    => false,
            'description' => 'Keep STDIN open even if not attached.',
        ];
    }

    public function execId(): array
    {
        return [
            'type'        => self::STRING_TYPE,
            'location'    => self::QUERY,
            'required'    => true,
            'description' => 'The ID of the exec session.',
        ];
    }
}
