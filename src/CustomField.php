<?php

/**
 * Setup options meta boxes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Customizer;

use WP_Customize_Manager;

class CustomField extends Base {

	public const DEFAULTS = array(
		'section' => '',
	);

	public function location( string $section ): self {

		$this->config['section'] = $section;

		return $this;

	}


	public function hook( WP_Customize_Manager $customizer ): void {

		$customizer->add_setting( $this->get_identifier(), array_merge( $this->config, array( 'type' => 'theme_mod' ) ) );
		$customizer->add_control( $this->get_identifier(), $this->transform( $this->config ) );

	}


	protected function transform( array $config ): array {

		$keys = array(
			'label'   => 'title',
			'choices' => 'options',
		);

		foreach ( $keys as $expected => $provided ) {
			$config[ $expected ] = $config[ $provided ];

			unset( $config[ $provided ] );
		}

		$supported = array(
			'text',
			'email',
			'url',
			'number',
			'hidden',
			'date',
			'checkbox',
			'textarea',
			'radio',
			'select',
			'dropdown-pages',
			'color',
		);

		if ( ! in_array( $config['type'], $supported, true ) ) {
			$config['type'] = 'text';
		}

		return $config;

	}

}
