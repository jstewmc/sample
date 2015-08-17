<?php

namespace Jstewmc\Sample;

/**
 * A quantitative sample
 *
 * A quantitative sample is a sequence of numbers like [1, 1, 2]. A quntitative 
 * sample may be composed of integers, floats, or a mix of both.
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2015 Jack Clayton
 * @license    MIT
 * @since      0.1.0
 */ 
class Quantitative extends \Jstewmc\Sample\Sample
{
	/* !Public methods */
	
	/**
	 * Returns the sample's standard deviation
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function deviation()
	{
		if (null !== ($variance = $this->variance())) {
			return sqrt($variance);
		}
		
		return null;
	}
	
	/**
	 * Returns the sample's maximum observation
	 *
	 * Keep in mind, PHP's native max() function will raise the error, "max(): array
	 * must contain at least one element", if $observations is empty.
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function max() 
	{
		return $this->n() ? max($this->observations) : null;
	}
	
	/**
	 * Returns the sample's arithmetic mean
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function mean()
	{
		return $this->n() ? $this->sum() / $this->n() : null;
	}
	
	/**
	 * Returns the sample's median
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function median()
	{
		$median = null;
		
		// if more than one observation exists
		if (1 < ($n = $this->n())) {
			// copy the observations 
			$observations = $this->observations;
			// get the middle key
			$k = $n / 2;
			// sort the observations in descending order
			rsort($observations);
			// if the number of observations is even
			if ($n % 2 === 0) {
				// average the two middle values
				$median = ($observations[$k - 1] + $observations[$k]) / 2;
			} else {
				// otherwise, the number of observations is odd
				// select the middle value
				$median = $observations[$k - 0.5];
			}
		}
		
		return $median;
	}
	
	/**
	 * Returns the sample's minimum value
	 *
	 * Keep in mind, PHP's native min() function will raise the error, "max(): array
	 * must contain at least one element", if $observations is empty.
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function min()
	{
		return $this->n() ? min($this->observations) : null;
	}
	
	/**
	 * Returns the sample's mode
	 *
	 * Keep in mind, a sample must be entirely composed of integers to have a mode.
	 * I'll work on a copy of the sample and cast all observations to its integer
	 * value. 
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function mode()
	{
		$mode = null;
		
		// if more than one observation exists
		if (1 < ($n = $this->n())) {
			// cast the observations as integers
			$observations = array_map(function ($v) {
				return (int) $v;
			}, $this->observations);
			// count the observations
			$frequencies = array_count_values($observations);
			// sort the frequencies in descending order
			arsort($frequencies);
			// reset the array's internal pointer, just to be sure
			reset($frequencies);
			// get the first key
			$mode = key($frequencies);
		}
		
		return $mode;
	}

	/**
	 * Returns the sample's product
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function product()
	{
		return $this->n() ? array_product($this->observations) : null;	
	}
	
	/**
	 * Returns the sample's range
	 *
	 * @return  int|float
	 * @since  0.1.0
	 */
	public function range()
	{
		return $this->n() ? $this->max() - $this->min() : null;
	}
	
	/**
	 * Returns the sample's sum
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function sum()
	{
		return $this->n() ? array_sum($this->observations) : null;
	}
	
	/**
	 * Returns the sample's sum of squared difference from the mean
	 *
	 * @return  int|float
	 * @since  0.1.0
	 */
	public function sumSquares()
	{
		$sumSquares = null;
		
		// if more than one observation exists
		if (1 < ($n = $this->n())) {
			// get the sample's mean
			$mean = $this->mean();
			// loop through the observations
			foreach ($this->observations as $observation) {
				// add each observation's squared distance from the mean
				$sumSquares += pow($observation - $mean, 2);
			}
		}
		
		return $sumSquares;
	}
	
	/**
	 * Returns the sample's variance
	 *
	 * @return  int|float|null
	 * @since  0.1.0
	 */
	public function variance()
	{
		if (null !== ($sumSquares = $this->sumSquares())) {
			return $sumSquares / ($this->n() - 1);
		}
		
		return null;
	}
}
