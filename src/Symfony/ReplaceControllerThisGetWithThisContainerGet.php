<?php declare(strict_types=1);

namespace Becklyn\Rector\Symfony;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceControllerThisGetWithThisContainerGet extends AbstractRector
{
    private ControllerAnalyzer $controllerAnalyzer;


    public function __construct(
        ControllerAnalyzer $controllerAnalyzer
    )
    {
        $this->controllerAnalyzer = $controllerAnalyzer;
    }


    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes () : array
    {
        return [MethodCall::class];
    }


    /**
     * @inheritDoc
     */
    public function refactor (Node $node) : ?Node
    {
        \assert($node instanceof MethodCall);

        if (!$this->isName($node->name, "get") || !$this->controllerAnalyzer->isInsideController($node))
        {
            return null;
        }

        $var = $node->var;

        if (!$var instanceof Variable || $var->name !== "this")
        {
            return null;
        }

        $node->var = new Node\Expr\PropertyFetch(
            new Variable("this"),
            new Identifier("container")
        );

        return $node;
    }


    /**
     * This method helps other to understand the rule and to generate documentation.
     */
    public function getRuleDefinition () : RuleDefinition
    {
        return new RuleDefinition(
            'Updates all Controllers that were previous fetching services directly via `$this->get()` to use `$this->container->get()` instead.', [
                new CodeSample(
                    '$this->get(SomeClass::class);',
                    '$this->container->get(SomeClass::class);'
                ),
            ]
        );
    }
}
