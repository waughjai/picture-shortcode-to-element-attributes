<?php

declare( strict_types = 1 );
namespace WaughJ\PictureShortcodeToElementAttributes
{
	function TransformPictureShortcodeToElementAttributes( array $atts ) : array
	{
		// Initialize
		$element_atts = [];
		$prefixes = [];
		$prefix_lengths = [];

		foreach ( PICTURE_ELEMENTS as $element )
		{
			// Where we will put the new versions o' the attributes for each element.
			$element_atts[ $element ] = [];
			// We need these for the lengths, so we might as well save these.
			$prefixes[ $element ] = "{$element}-";
			// Optimization: save string lengths so we don't recalculate these for every attribute x element, but can just reference them directly.
			$prefix_lengths[ $element ] = strlen( $prefixes[ $element ] );
		}

		// Convert attributes
		foreach ( $atts as $attribute_key => $attribute_value )
		{
			foreach ( PICTURE_ELEMENTS as $element )
			{
				$prefix = $prefixes[ $element ];
				$prefix_length = $prefix_lengths[ $element ];
				$starts_with_prefix = ( strpos( $attribute_key, $prefix ) === 0 );
				if ( $starts_with_prefix )
				{
					$attribute_key_without_prefix = substr( $attribute_key, $prefix_length );
					$element_atts[ $element ][ $attribute_key_without_prefix ] = $attribute_value; // Set new version o' attribute.
					unset( $atts[ $attribute_key ] ); // Get rid of ol' version o' attribute.
				}
			}
		}

		// Finally, add all new versions o' attributes to original attributes.
		foreach ( PICTURE_ELEMENTS as $element )
		{
			$atts[ "{$element}-attributes" ] = $element_atts[ $element ];
		}

		return $atts;
	}

	const PICTURE_ELEMENTS = [ 'img', 'picture', 'source' ];
}
