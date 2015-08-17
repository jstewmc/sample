<?php

namespace Jstewmc\Sample;

/**
 * Tests for the Qualitative class
 */
class QualitativeTest extends \PHPUnit_Framework_TestCase
{
	/* !__construct() */
	
	/**
	 * __construct() should return object if $observations is empty
	 */
	public function test_construct_returnsObject_ifObservationsIsEmpty()
	{
		$sample = new Qualitative();
		
		$this->assertTrue($sample instanceof Qualitative);
		$this->assertEquals([], $sample->getObservations());
		
		return;
	}
	
	/**
	 * __construct() should return object if $observations is not empty
	 */
	public function test_construct_returnsObject_ifObservationsIsNotEmpty()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative($observations);
		
		$this->assertTrue($sample instanceof Qualitative);
		$this->assertEquals($observations, $sample->getObservations());
		
		return;
	}
	
	
	/* !append() */
	
	/**
	 * append() should return self if observations do not exist
	 */
	public function test_append_returnsSelf_ifObservationsDoNotExist()
	{
		$sample = new Qualitative();
		
		$this->assertSame($sample, $sample->append('foo'));
		$this->assertEquals(1, $sample->n());
		$this->assertEquals('foo', $sample->get('first'));
		
		return;
	}
	
	/**
	 * append() should return self if observations do exist
	 */
	public function test_append_returnsSelf_ifObservationsDoExist()
	{
		$sample = new Qualitative();
		
		$sample->setObservations(['foo', 'bar']);
		
		$this->assertSame($sample, $sample->append('baz'));
		$this->assertEquals(3, $sample->n());
		$this->assertEquals('baz', $sample->get('last'));
		
		return;
	}
	
	
	/* !get() */
	
	/**
	 * get() should throw an InvalidArgumentException if $offset is neither a string
	 * nor an integer
	 */
	public function test_get_throwsInvalidArgumentException_ifOffsetIsNeitherAStringNorInteger()
	{
		$this->setExpectedException('InvalidArgumentException');
		
		(new Qualitative())->get([]);
		
		return;
	}
	
	/**
	 * get() should throw an OutOfBoundsException if $offset is invalid index
	 */
	public function test_get_throwsOutOfBoundsException_ifOffsetIsInvalidIndex()
	{
		$this->setExpectedException('OutOfBoundsException');
		
		(new Qualitative())->get(999);
		
		return;
	}
	
	/**
	 * get() should throw an InvalidArgumentException if $offset is invalid string
	 */
	public function test_get_throwsInvalidArgumentException_ifOffsetIsInvalidString()
	{
		$this->setExpectedException('InvalidArgumentException');
		
		(new Qualitative())->get('foo');
		
		return;	
	}
	
	/**
	 * get() should return string if $offset is valid index
	 */
	public function test_get_returnsString_ifOffsetIsValidIndex()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertEquals('bar', $sample->get(1));
		
		return;
	}
	
	/**
	 * get() should return string if $offset is valid string
	 */
	public function test_get_returnsString_ifOffsetIsValidString()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertEquals('foo', $sample->get('first'));
		$this->assertEquals('baz', $sample->get('last'));
		
		return;
	}
	
	
	/* !getObservations() */
	
	/**
	 * getObservations() should return an array if observations do not exist
	 */
	public function test_getObservations_returnsArray_ifObservationsDoNotExist()
	{
		return $this->assertEquals([], (new Qualitative())->getObservations());
	
	}
	
	/**
	 * getObservations() should return an array if observations do exist
	 */
	public function test_getObservations_returnsArray_ifObservationsDoExist()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		return $this->assertEquals($observations, $sample->getObservations());
	}
	
	
	/* !mode() */
	
	/**
	 * mode() should return null if observations do not exist
	 */
	public function test_mode_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Qualitative())->mode());
	}
	
	/**
	 * mode() should return string if frequencies are equal
	 */
	public function test_mode_returnsString_ifFrequenciesAreEqual()
	{
		$observations = ['foo', 'foo', 'bar'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertTrue(in_array($sample->mode(), $observations));
		
		return;
	}
	
	/**
	 * mode() should return string if frequencies are not equal
	 */
	public function test_mode_returnsString_ifFrequenciesAreNotEqual()
	{
		$observations = ['foo', 'bar', 'baz', 'foo'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertEquals('foo', $sample->mode());
		
		return;
	}
	
	
	/* !n() */
	
	/**
	 * n() should return int if observations do not exist
	 */
	public function test_n_returnsInt_ifObservationsDoNotExist()
	{
		return $this->assertEquals(0, (new Qualitative())->n());
	}
	
	/**
	 * n() should return int if observations do exist
	 */
	public function test_n_returnsInt_ifObservationsDoExist()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		return $this->assertEquals(3, $sample->n());
	}
	
	
	/* !prepend() */
	
	/**
	 * prepend() should prepend observation and return self if observations do not 
	 * exist
	 */
	public function test_prepend_returnsSelf_ifObservationsDoNotExist()
	{
		$sample = new Qualitative();
		
		$this->assertSame($sample, $sample->prepend('foo'));
		$this->assertEquals(1, $sample->n());
		$this->assertEquals('foo', $sample->get('first'));
		
		return;
	}
	
	/**
	 * prepend() should prepend observation and return self if observations do exist
	 */
	public function test_prepend_returnsSelf_ifObservationsDoExist()
	{
		$sample = new Qualitative();
		
		$sample->setObservations(['bar', 'baz']);
		
		$this->assertSame($sample, $sample->prepend('foo'));
		$this->assertEquals(3, $sample->n());
		$this->assertEquals('foo', $sample->get('first'));
		
		return;
	}
	
	
	/* !pop() */
	
	/**
	 * pop() should return null if observations do not exist
	 */
	public function test_pop_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Qualitative())->pop());
	}
	
	/**
	 * pop() should return string if observations do exist
	 */
	public function test_pop_returnsString_ifObservationsDoExist()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertEquals('baz', $sample->pop());
		$this->assertEquals(2, $sample->n());
		
		return;
	}
	
	
	/* !shift() */
	
	/**
	 * shift() should return null if observations do not exist
	 */
	public function test_shift_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Qualitative())->shift());
	}
	
	/**
	 * shift() should return string if observations do exist
	 */
	public function test_shift_returnsString_ifObservationsDoExist()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		$sample->setObservations($observations);
		
		$this->assertEquals('foo', $sample->shift());
		$this->assertEquals(2, $sample->n());
		
		return;
	}
	
	
	/* !setObservations() */
	
	/**
	 * setObservations() should return self if $observations is an array
	 */
	public function test_setObservations()
	{
		$observations = ['foo', 'bar', 'baz'];
		
		$sample = new Qualitative();
		
		$this->assertSame($sample, $sample->setObservations($observations));
		$this->assertEquals($observations, $sample->getObservations());
		
		return;
	}
}
