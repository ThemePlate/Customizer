<?php

/**
 * Setup options meta boxes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Customizer;

use ThemePlate\Core\Fields;
use WP_Customize_Manager;

class CustomSection extends Base {

	public const DEFAULTS = array(
		'panel' => '',
	);

	protected ?Fields $fields = null;


	public function fields( array $list ): self {

		$this->fields = new Fields( $list );

		return $this;

	}


	public function location( string $panel ): self {

		$this->config['panel'] = $panel;

		return $this;

	}


	public function hook( WP_Customize_Manager $customizer ): void {

		$customizer->add_section( $this->get_identifier(), $this->config );

		if ( null !== $this->fields ) {
			foreach ( $this->fields->get_collection() as $field ) {
				$config = $field->get_config();

				$config['data_prefix'] = $this->get_config( 'data_prefix' );

				( new CustomField( $field->get_config( 'title' ), $config ) )
					->location( $this->get_identifier() )
					->hook( $customizer );
			}
		}

	}

}
