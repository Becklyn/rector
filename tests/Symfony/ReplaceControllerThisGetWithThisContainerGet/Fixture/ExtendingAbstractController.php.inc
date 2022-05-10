<?php

namespace Tests\Becklyn\Rector\Symfony\ReplaceControllerThisGetWithThisContainerGet\Fixture;

class ExtendingAbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function run()
    {
        $this->get(SomeClass::class);
    }

    public function runFaster()
    {
        $service = $this->get(SomeOtherClass::class);
    }

    public function runEvenFaster()
    {
        return $this->get(BestClass::class);
    }
}

?>
-----
<?php

namespace Tests\Becklyn\Rector\Symfony\ReplaceControllerThisGetWithThisContainerGet\Fixture;

class ExtendingAbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function run()
    {
        $this->container->get(SomeClass::class);
    }

    public function runFaster()
    {
        $service = $this->container->get(SomeOtherClass::class);
    }

    public function runEvenFaster()
    {
        return $this->container->get(BestClass::class);
    }
}

?>
