<?php

/**
 * Setup options meta boxes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Customizer;

class Helpers {

	public const CONTROL_PROPERTIES_MAP = array(
		'label'   => 'title',
		'choices' => 'options',
	);

	public const SUPPORTED_CONTROL_TYPES = array(
		'text',
		'email',
		'password',
		'file',
		'url',
		'number',
		'range',
		'tel',
		'hidden',
		'date',
		'time',
		'datetime-local',
		'checkbox',
		'textarea',
		'radio',
		'select',
		'dropdown-pages',
		'color',
	);


	public static function transform_control_properties( array $config ): array {

		foreach ( self::CONTROL_PROPERTIES_MAP as $expected => $provided ) {
			if ( ! isset( $config[ $provided ] ) ) {
				continue;
			}

			$config[ $expected ] = $config[ $provided ];

			unset( $config[ $provided ] );
		}

		return $config;

	}


	public static function get_control_type( array $config ): string {

		if ( ! in_array( $config['type'], self::SUPPORTED_CONTROL_TYPES, true ) ) {
			return 'text';
		}

		return $config['type'];

	}


	public static function setting_args( CustomField $field ): array {

		$args = $field->get_config();

		$args['type'] = 'theme_mod';

		return $args;

	}


	public static function control_args( CustomField $field ): array {

		$args = self::transform_control_properties( $field->get_config() );

		$args['type'] = self::get_control_type( $args );

		return $args;

	}

}
