<?php

namespace Tests\Provider;

use Entretien\NewsBundle\Provider\CommentProvider;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class CommentProviderTest extends TestCase
{
    private $entityManager;
    private $commentProvider;

    protected function setUp()
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->commentProvider = new CommentProvider($this->entityManager);
    }

    protected function tearDown()
    {
        $this->entityManager = null;
        $this->commentProvider = null;
    }

    /**
     * @dataProvider incrementIntProvider
     */
    public function testIncrementNbCommentShouldReturnOneMore($init, $expected)
    {
        $nbComment = $this->commentProvider->incrementNbComment($init);

        $this->assertSame($expected, $nbComment);
    }

    public function testIncrementNbCommentShouldReturnInteger()
    {
        $nbComment = $this->commentProvider->incrementNbComment(5);

        $this->assertInternalType('integer', $nbComment);
    }

    /**
     * @dataProvider incrementNoIntProvider
     * @expectedException \TypeError
     */
    public function testIncrementNbCommentShouldThrowInvalidArgumentExecption($init)
    {
        $nbComment = $this->commentProvider->incrementNbComment($init);
    }

    public function incrementIntProvider()
    {
        return [
            [5, 6],
            [7, 8],
            [0, 1],
            [10000, 10001],
        ];
    }

    public function incrementNoIntProvider()
    {
        return [
            ['string'],
            [null],
            [array('first item' => 1,
                    'second item' => 2, )],
        ];
    }
}
