<?php

namespace OpenStack\Containers\v1;

abstract class Enum
{
    private function __construct()
    {
    }

    public const KIND_CAPSULE = 'capsule';

    public const RESTART_POLICY_ALWAYS     = 'Always';
    public const RESTART_POLICY_ON_FAILURE = 'OnFailure';
    public const RESTART_POLICY_NEVER      = 'Never';

    public const PORT_PROTOCOL_TCP = 'TCP';
    public const PORT_PROTOCOL_UDP = 'UDP';

    private function __clone()
    {
    }
}
