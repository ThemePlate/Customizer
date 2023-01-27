<?php

/**
 * @package ThemePlate
 */

namespace Tests;

use ThemePlate\Customizer\Base;
use WP_Customize_Manager;
use WP_UnitTestCase;

class BaseTest extends WP_UnitTestCase {
	protected Base $base;
	protected string $title  = 'My Base';
	protected string $prefix = 'themeplate_';

	protected function setUp(): void {
		$config = array();

		if ( 'test_config_with_prefix' === $this->getName() ) {
			$config['data_prefix'] = $this->prefix;
		}

		$this->base = new class( $this->title, $config ) extends Base {
			public function hook( WP_Customize_Manager $customizer ): void {
				echo 'HOOKED!';
			}
		};

		parent::setUp();
	}

	public function test_default_config(): void {
		$expected = array(
			'data_prefix' => '',
			'id'          => sanitize_title( $this->title ),
			'title'       => $this->title,
		);

		$this->assertEquals( $expected, $this->base->get_config() );
	}

	public function test_config_with_prefix(): void {
		$expected = array(
			'data_prefix' => $this->prefix,
			'id'          => sanitize_title( $this->title ),
			'title'       => $this->title,
		);

		$this->assertEquals( $expected, $this->base->get_config() );
	}

	public function test_create_manually_fired(): void {
		$this->base->create();

		$this->assertSame( 10, has_action( 'customize_register', array( $this->base, 'hook' ) ) );
	}

	public function test_create_hooked_to_action(): void {
		add_action( 'customize_register', array( $this->base, 'create' ) );

		ob_start();
		// mimic customizer page
		$_REQUEST['wp_customize'] = 'on';
		_wp_customize_include();
		do_action( 'wp_loaded' );

		$this->assertSame( 'HOOKED!', ob_get_clean() );
	}
}
