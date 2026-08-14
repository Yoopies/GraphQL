<?php

namespace Youshido\Tests\Library\Type;

use PHPUnit\Framework\TestCase;use Youshido\GraphQL\Directive\Directive;
use Youshido\GraphQL\Type\SchemaDirectivesList;

class SchemaDirectivesListTest extends TestCase
{
    public function testCanAddASingleDirective(): void
    {
        $directiveList = new SchemaDirectivesList();
        $directiveList->addDirective(
            new Directive([
                'name' => 'testDirective'
            ])
        );
        $this->assertTrue($directiveList->isDirectiveNameRegistered('testDirective'));
    }

    public function testCanAddMultipleDirectives(): void
    {
        $directiveList = new SchemaDirectivesList();
        $directiveList->addDirectives([
            new Directive([
                'name' => 'testDirectiveOne'
            ]),
            new Directive([
                'name' => 'testDirectiveTwo'
            ]),
        ]);
        $this->assertTrue($directiveList->isDirectiveNameRegistered('testDirectiveOne'));
        $this->assertTrue($directiveList->isDirectiveNameRegistered('testDirectiveTwo'));
    }

    public function testItThrowsExceptionWhenAddingInvalidDirectives(): void
    {
        $this->expectException(\TypeError::class);
        $directiveList = new SchemaDirectivesList();
        $directiveList->addDirectives("foobar");
    }

}
