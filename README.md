Becklyn Rector
==============

This package contains a list of Rector rules that help you up-grading your Symfony-based code base and keeping it deprecation-free.


Usage
=====

Add the rules that you want 

This bundle uses a default AJAX protocol, that is used in the `AjaxResponseBuilder` and can be used for your
project. The ajax call will always return an error 200, as it shouldn't flood the error tracking (with error 400
AJAX request).

The protocol looks like this:

```php
// rector.php

use Becklyn\Rector\Symfony\ReplaceControllerThisGetWithThisContainerGet;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    // …
    
    $rectorConfig->rule(ReplaceControllerThisGetWithThisContainerGet::class);
    
    // …
};
```


Available rules
===============

### `Becklyn\\Rector\\Symfony\\ReplaceControllerThisGetWithThisContainerGet`

Controllers that were trying to access dependencies via `$this->get(…)` will be refactored to use `$this->container->get(…)`.

Before:

```php
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
```

After:

```php
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
```
