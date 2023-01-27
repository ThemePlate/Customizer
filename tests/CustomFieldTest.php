<?php

/**
 * @package ThemePlate
 */

namespace Tests;

use ThemePlate\Customizer\CustomField;
use WP_UnitTestCase;

class CustomFieldTest extends WP_UnitTestCase {
	public function test_config_with_location(): void {
		$title = 'My Field';
		$field = new CustomField( $title );

		$section = 'my-section';

		$field->location( $section );

		$expected = array(
			'data_prefix' => '',
			'id'          => sanitize_title( $title ),
			'title'       => $title,
			'section'     => $section,
		);

		$this->assertEquals( $expected, $field->get_config() );
	}
}
