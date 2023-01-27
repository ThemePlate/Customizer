<?php

/**
 * Setup options meta boxes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Customizer;

use ThemePlate\Core\Fields;
use ThemePlate\Core\Helper\MainHelper;
use WP_Customize_Manager;

abstract class Base {

	public const DEFAULTS = array(
		'data_prefix' => '',
	);

	protected array $config;


	public function __construct( string $title, array $config = array() ) {

		$this->config = MainHelper::fool_proof( self::DEFAULTS, $config );
		$this->config = MainHelper::fool_proof( static::DEFAULTS, $this->config );

		$this->config['id']    = sanitize_title( $title );
		$this->config['title'] = $title;

	}


	/**
	 * @return array|mixed|null
	 */
	public function get_config( string $key = '' ) {

		if ( '' === $key ) {
			return $this->config;
		}

		return $this->config[ $key ] ?? null;

	}


	public function get_identifier(): string {

		return $this->config['data_prefix'] . $this->config['id'];

	}


	public function create( ?WP_Customize_Manager $customizer = null ): void {

		if ( did_action( 'customize_register' ) && null !== $customizer ) {
			$this->hook( $customizer );
		} else {
			add_action( 'customize_register', array( $this, 'hook' ) ); // @codeCoverageIgnore
		}

	}


	abstract public function hook( WP_Customize_Manager $customizer ): void;

}
