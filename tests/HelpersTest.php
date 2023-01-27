<?php

/**
 * @package ThemePlate
 */

namespace Tests;

use ThemePlate\Customizer\CustomField;
use ThemePlate\Customizer\Helpers;
use WP_UnitTestCase;

class HelpersTest extends WP_UnitTestCase {
	public function test_transform_control_properties(): void {
		$config = array(
			'title'   => 'My Control',
			'options' => array( 'one', 'two', 'three' ),
			'custom'  => 'stays',
		);

		$returned = Helpers::transform_control_properties( $config );

		foreach ( Helpers::CONTROL_PROPERTIES_MAP as $expected => $provided ) {
			$this->assertArrayHasKey( $expected, $returned );
			$this->assertArrayNotHasKey( $provided, $returned );
		}

		$this->assertArrayHasKey( 'custom', $returned );
		$this->assertSame( 'stays', $returned['custom'] );
	}

	public function test_get_control_type(): void {
		$types = array(
			'number',
			'textarea',
			'select',
			'color',
		);

		foreach ( $types as $type ) {
			$returned = Helpers::get_control_type( compact( 'type' ) );
			$this->assertSame( $type, $returned );
		}

		$this->assertSame( 'text', Helpers::get_control_type( array( 'type' => 'custom' ) ) );
	}

	public function test_setting_args(): void {
		$config = array(
			'type'   => 'config',
			'custom' => 'stays',
		);

		$field = new CustomField( 'Test', $config );

		$returned = Helpers::setting_args( $field );

		$this->assertSame( 'theme_mod', $returned['type'] );
		$this->assertSame( 'stays', $returned['custom'] );
		$this->assertSame( 'Test', $returned['title'] );
		$this->assertSame( 'test', $returned['id'] );
	}

	public function test_control_args(): void {
		$config = array(
			'type'   => 'config',
			'custom' => 'stays',
		);

		$field = new CustomField( 'Test', $config );

		$returned = Helpers::control_args( $field );

		$this->assertSame( 'text', $returned['type'] );
		$this->assertSame( 'stays', $returned['custom'] );
		$this->assertSame( 'Test', $returned['label'] );
		$this->assertSame( 'test', $returned['id'] );
	}
}
