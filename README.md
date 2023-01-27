# ThemePlate Customizer

## Usage

```php
use ThemePlate\Customizer\CustomSection;

( new CustomSection( 'My Section' ) )->fields( $list )->location( 'panel' )->create();
```

```php
use ThemePlate\Customizer\CustomSection;

add_action( 'customize_register', function( $customizer ) {
	$customizer->add_panel( 'my-panel', array( 'title' => 'My Panel' ) );

	/** https://developer.wordpress.org/reference/classes/wp_customize_section/__construct/#parameters */
	$args = array(
		'panel'       => 'my-panel',
		'description' => 'This is an example.',
	);

	$section = new CustomSection( 'Another Section', $args );

	$section->fields( $list )->hook( $customizer );
} );
```
