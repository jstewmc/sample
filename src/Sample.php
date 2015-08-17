<?php

namespace Jstewmc\Sample;

/**
 * A statistical sample
 *
 * A statistical sample is a sequence of qualitative or quantitative observations. 
 * For example, ['foo', 'bar', 'baz'] or [1, 2, 3], respectively.
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2015 Jack Clayton
 * @license    MIT
 * @since      0.1.0
 */
abstract class Sample
{
	/* !Protected properties */
	
	/**
	 * @var  mixed[]  the sample's observations
	 * @since  0.1.0
	 */
	protected $observations = [];
	
	
	/* !Get methods */
	
	/**
	 * Gets the sample's observations
	 *
	 * @return  mixed[]  the sample's observations
	 * @since  0.1.0
	 */
	public function getObservations()
	{
		return $this->observations;
	}
	
	
	/* !Set methods */
	
	/**
	 * Sets the sample's observations
	 *
	 * @param  mixed[]  the sample's observations
	 * @return  self
	 * @since  0.1.0
	 */
	public function setObservations(Array $observations)
	{
		$this->observations = $observations;
		
		return $this;
	}
	
	
	/* !Magic methods */
	
	/**
	 * Called when the object is constructed
	 *
	 * @param  mixed[]  $observations  the sample's observations
	 * @return  self
	 * @since  0.1.0
	 */
	public function __construct(Array $observations = []) 
	{
		$this->observations = $observations;
		
		return;
	}
	
	
	/* !Public methods */
	
	/**
	 * Appends an observation to the sample
	 *
	 * @param  mixed  $observation  the observation to append
	 * @return  self
	 * @since  0.1.0
	 */
	public function append($observation)
	{
		array_push($this->observations, $observation);
		
		return $this;
	}
	
	/**
	 * Gets the observation at $offset
	 *
	 * @param  string|int  $offset  
	 * @return  mixed
	 * @throws  InvalidArgumentException  if $offset is neither a string nor integer
	 * @throws  OutOfBoundsException      if $offset is a integer, but it's invalid
	 * @throws  InvalidArgumentException  if $offset is a string, but it's invalid
	 * @since  0.1.0
	 */
	public function get($offset)
	{
		// if $offset is neither a number nor a string, short-circuit
		$isNumeric = is_numeric($offset) && is_int(+$offset);
		$isString  = is_string($offset);
		if ( ! $isNumeric && ! $isString) {
			throw new \InvalidArgumentException(
				__METHOD__."() expects parameter one, offset, to be an integer or a "
					. "string"
			);
		}
		
		if ($isNumeric) {
			$index = $this->getIndex($offset);
			if ($index >= 0 && array_key_exists($index, $this->observations)) {
				$observation = $this->observations[$index];
			} else {
				throw new \OutOfBoundsException(
					__METHOD__."() expects parameter one, offset, to result in a "
						. "valid index when it's an integer; $index is not a valid "
						. "index"
				);
			}
		} else {
			switch (strtolower($offset)) {
				
				case 'first':
					$observation = reset($this->observations);
					break;
				
				case 'last':
					$observation = end($this->observations);
					break;
				
				case 'rand':
				case 'random':
					$observation = $this->observations[
						array_rand($this->observations)
					];
					break;
				
				default:
					throw new \InvalidArgumentException(
						__METHOD__."() expects parameter one, offset, to be one of "
							. "the following strings when it's not an integer: "
							. "'first', 'last', or 'rand[om]'; '$offset' is not "
							. "supported"
					);
			}
		}
		
		return $observation;
	}
	
	/**
	 * Returns the sample's mode
	 *
	 * @return  mixed
	 * @since  0.1.0
	 */
	abstract public function mode();
	
	/**
	 * Returns the sample's "n"
	 *
	 * @return  int
	 * @since  0.1.0
	 */
	public function n()
	{
		return count($this->observations);
	}
	
	/**
	 * Prepends an observation to the sample
	 * 
	 * @param  mixed  $observation  the observation to append
	 * @return  self
	 * @since  0.1.0
	 */
	public function prepend($observation)
	{
		array_unshift($this->observations, $observation);
		
		return $this;
	}
	
	/**
	 * Pops the last observation off the end of the sample and returns it
	 *
	 * @return  mixed|null
	 * @since  0.1.0
	 */
	public function pop()
	{
		return array_pop($this->observations);
	}
	
	/**
	 * Shifts the first observation off the front of the sample and returns it
	 *
	 * @return  mixed|null
	 * @since  0.1.0
	 */
	public function shift()
	{
		return array_shift($this->observations);
	}
	
	
	/* !Protected methods */
	
	/**
	 * Returns an index in $observations based on $offset
	 *
	 * @param  int  $offset  the array's offset
	 * @return  int  the array's index
	 * @throws  InvalidArgumentException  if $offset is not a string
	 * @since   0.1.0
	 */
	protected function getIndex($offset)
	{
		if ( ! is_numeric($offset) && is_int(+$offset)) {
			throw new \InvalidArgumentException(
				__METHOD__."() expects parameter one, offset, to be an integer"
			);	
		}
		
		return $offset < 0 ? count($this->observations) + $offset : $offset;
	}
}
