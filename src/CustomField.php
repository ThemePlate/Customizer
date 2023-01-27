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

		$customizer->add_setting( $this->get_identifier(), Helpers::setting_args( $this ) );
		$customizer->add_control( $this->get_identifier(), Helpers::control_args( $this ) );

	}

}
