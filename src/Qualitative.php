<?php

namespace Jstewmc\Sample;

/** 
 * A qualitative sample
 *
 * A qualitative sample is a sequence of strings like ['foo', 'bar', 'baz'].
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2015 Jack Clayton
 * @license    MIT
 * @since      0.2.0
 */
class Qualitative extends Sample
{
	/* !Public methods */
	
	/**
	 * Returns the sample's mode
	 *
	 * @return  string|null
	 * @since  0.1.0
	 */
	public function mode()
	{
		$mode = null;
		
		// if more than one observation exists
		if (1 < ($n = $this->n())) {
			// count the observations by value
			$frequencies = array_count_values($this->observations);
			// sort the frequencies in descending order
			arsort($frequencies);
			// reset the internal pointer, just to be sure
			reset($frequencies);
			// get the key of the first element
			$mode = key($frequencies);
		}
		
		return $mode;
	}
}
