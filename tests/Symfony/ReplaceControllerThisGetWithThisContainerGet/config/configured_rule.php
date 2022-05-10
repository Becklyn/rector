<?php

declare (strict_types=1);
namespace RectorPrefix20220501;

use Becklyn\Rector\Symfony\ReplaceControllerThisGetWithThisContainerGet;
use Rector\Config\RectorConfig;

return static function (\Rector\Config\RectorConfig $rectorConfig) : void {
    $rectorConfig->rule(ReplaceControllerThisGetWithThisContainerGet::class);
};
