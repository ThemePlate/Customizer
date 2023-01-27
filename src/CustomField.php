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

	public function create( WP_Customize_Manager $customizer ): void {

		$customizer->add_setting( $this->id, array_merge( $this->config, array( 'type' => 'theme_mod' ) ) );
		$customizer->add_control( $this->id, $this->config );

	}

}
