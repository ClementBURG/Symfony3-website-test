<?php

namespace Tests\Provider;

use Entretien\NewsBundle\Entity\Advert;
use Entretien\NewsBundle\Provider\CommentProvider;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class CommentProviderTest extends TestCase
{
	/**
	 * @dataProvider incrementIntProvider
	 */
	public function testIncrementNbCommentShouldReturnOneMore($init, $expected)
	{
		//Arrange
		$em = $this->createMock(EntityManager::class);
		$cp = new CommentProvider($em);
		//Act
		$res = $cp->incrementNbComment($init);
		//Assert
		$this->assertEquals($expected, $res);
	}

	public function testIncrementNbCommentShouldReturnInteger()
	{
		//Arrange
		$em = $this->createMock(EntityManager::class);
		$cp = new CommentProvider($em);
		//Act
		$res = $cp->incrementNbComment(5);
		//Assert
		$this->assertInternalType('integer', $res);
	}

	/**
	 * @dataProvider incrementNoIntProvider
	 * @expectedException TypeError
	 */
	public function testIncrementNbCommentShouldThrowInvalidArgumentExecption($init)
	{
		//Arrange
		$em = $this->createMock(EntityManager::class);
		$cp = new CommentProvider($em);
		//Act
		$res = $cp->incrementNbComment($init);
	}

	public function incrementIntProvider()
	{
		return [
			[5, 6],
			[7, 8],
			[0, 1],
			[10000, 10001]
		];
	}

	public function incrementNoIntProvider()
	{
		return [
			['string'],
			[NULL],
			[array('first item' => 1,
					'second item' => 2)]
		];
	}
}