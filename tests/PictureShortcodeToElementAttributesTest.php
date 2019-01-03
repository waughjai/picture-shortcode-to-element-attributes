<?php

use PHPUnit\Framework\TestCase;
use function WaughJ\PictureShortcodeToElementAttributes\TransformPictureShortcodeToElementAttributes;

class PictureShortcodeToElementAttributesTest extends TestCase
{
	public function testTransform()
	{
		$shortcode_att = [ 'img-class' => 'something', 'picture-id' => 222, 'source-width' => '555' ];
		$element_att = TransformPictureShortcodeToElementAttributes( $shortcode_att );
		$this->assertTrue( array_key_exists( 'img-attributes', $element_att ) );
		$this->assertTrue( array_key_exists( 'class', $element_att[ 'img-attributes' ] ) );
		$this->assertEquals( $element_att[ 'img-attributes' ][ 'class' ], 'something' );
		$this->assertTrue( array_key_exists( 'picture-attributes', $element_att ) );
		$this->assertTrue( array_key_exists( 'id', $element_att[ 'picture-attributes' ] ) );
		$this->assertEquals( $element_att[ 'picture-attributes' ][ 'id' ], 222 );
		$this->assertTrue( array_key_exists( 'source-attributes', $element_att ) );
		$this->assertTrue( array_key_exists( 'width', $element_att[ 'source-attributes' ] ) );
		$this->assertEquals( $element_att[ 'source-attributes' ][ 'width' ], 555 );
	}
}
