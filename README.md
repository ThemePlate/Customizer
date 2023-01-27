# ThemePlate Customizer

## Usage

```php
use ThemePlate\Customizer\CustomSection;

$section = new CustomSection( 'My Section', $args );

$section->fields( $list );

add_action( 'customize_register', array( $section, 'create' ) );
```
