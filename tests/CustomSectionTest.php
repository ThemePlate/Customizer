<?php

/**
 * @package ThemePlate
 */

namespace Tests;

use ThemePlate\Customizer\CustomSection;
use WP_UnitTestCase;

class CustomSectionTest extends WP_UnitTestCase {
	public function test_config_with_location(): void {
		$title   = 'My Section';
		$section = new CustomSection( $title );

		$panel = 'my-panel';

		$section->location( $panel );

		$expected = array(
			'data_prefix' => '',
			'id'          => $section->get_identifier(),
			'title'       => $title,
			'panel'       => $panel,
		);

		$this->assertEquals( $expected, $section->get_config() );
	}
}
