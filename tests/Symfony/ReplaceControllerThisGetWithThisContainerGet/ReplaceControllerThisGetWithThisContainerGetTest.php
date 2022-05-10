<?php

declare(strict_types=1);

namespace Tests\Becklyn\Rector\Symfony\ReplaceControllerThisGetWithThisContainerGet;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ReplaceControllerThisGetWithThisContainerGetTest extends AbstractRectorTestCase
{
    /**
     * @return \Iterator<SmartFileInfo>
     */
    public function provideData () : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }


    /**
     * @dataProvider provideData()
     */
    public function test (SmartFileInfo $fileInfo) : void
    {
        $this->doTestFileInfo($fileInfo);
    }


    /**
     * @inheritDoc
     */
    public function provideConfigFilePath () : string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
