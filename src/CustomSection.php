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

	protected ?Fields $fields = null;


	public function fields( array $list ): self {

		$this->fields = new Fields( $list );

		return $this;

	}


	public function create( WP_Customize_Manager $customizer ): void {

		$customizer->add_section( $this->id, $this->config );

		if ( null !== $this->fields ) {
			foreach ( $this->fields->get_collection() as $field ) {
				$config = $field->get_config();

				$config['section'] = $this->id;

				( new CustomField( $field->get_config( 'title' ), $config ) )->create( $customizer );
			}
		}

	}

}
