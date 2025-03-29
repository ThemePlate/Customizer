<?php

/**
 * Setup options meta boxes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Customizer;

use ThemePlate\Core\Fields;
use ThemePlate\Core\Helper\FieldsHelper;
use WP_Customize_Manager;

class CustomSection extends Base {

	public const DEFAULTS = array(
		'panel' => '',
	);

	protected ?Fields $fields = null;


	public function fields( array $collection ): self {

		$this->fields = new Fields( $collection );

		return $this;

	}


	public function location( string $panel ): self {

		$this->config['panel'] = $panel;

		return $this;

	}


	public function hook( WP_Customize_Manager $customizer ): void {

		$customizer->add_section( $this->get_identifier(), $this->config );

		if ( $this->fields instanceof Fields ) {
			foreach ( $this->fields->get_collection() as $field ) {
				$config = $field->get_config();

				$prefix            = $this->get_config( 'data_prefix' );
				$config['id']      = $field->data_key( $prefix );
				$config['default'] = FieldsHelper::get_default_value( $field );

				( new CustomField( $field->get_config( 'title' ), $config ) )
					->location( $this->get_identifier() )
					->hook( $customizer );
			}
		}

	}

}
