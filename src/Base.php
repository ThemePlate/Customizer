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

abstract class Base {

	protected ?Fields $fields = null;

	protected array $config;
	protected string $id;


	public function __construct( string $title, array $config = array() ) {

		$this->id = sanitize_title( $title );

		$this->config = $config;

		$this->config['title'] = $title;

	}


	abstract public function create( WP_Customize_Manager $customizer ): void;

}
