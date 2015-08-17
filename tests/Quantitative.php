<?php

namespace Jstewmc\Sample;

/**
 * Tests for the Quantitative class
 */
class QuantitativeTest extends \PHPUnit_Framework_TestCase
{
	/* !__construct() */
	
	/**
	 * __construct() should return object if $observations is empty
	 */
	public function test_construct_returnsObject_ifObservationsIsEmpty()
	{
		$sample = new Quantitative();
		
		$this->assertTrue($sample instanceof Quantitative);
		$this->assertEquals([], $sample->getObservations());
		
		return;
	}
	
	/**
	 * __construct() should return object if $observations is not empty
	 */
	public function test_construct_returnsObject_ifObservationsIsNotEmpty()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative($observations);
		
		$this->assertTrue($sample instanceof Quantitative);
		$this->assertEquals($observations, $sample->getObservations());
		
		return;
	}
	
	
	/* !append() */
	
	/**
	 * append() should return self if observations do not exist
	 */
	public function test_append_returnsSelf_ifObservationsDoNotExist()
	{
		$sample = new Quantitative();
		
		$this->assertSame($sample, $sample->append(1));
		$this->assertEquals(1, $sample->n());
		$this->assertEquals(1, $sample->get('first'));
		
		return;
	}
	
	/**
	 * append() should return self if observations do exist
	 */
	public function test_append_returnsSelf_ifObservationsDoExist()
	{
		$sample = new Quantitative();
		
		$sample->setObservations([1, 2]);
		
		$this->assertSame($sample, $sample->append(3));
		$this->assertEquals(3, $sample->n());
		$this->assertEquals(3, $sample->get('last'));
		
		return;
	}
	
	
	/* !deviation() */
	
	/**
	 * deviation() should return null if observations do not exist
	 */
	public function test_deviation_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->deviation());
	}	
	
	/**
	 * deviation() should return number if observations do exist
	 */
	public function test_deviation_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->deviation());
		
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
		
		(new Quantitative())->get([]);
		
		return;
	}
	
	/**
	 * get() should throw an OutOfBoundsException if $offset is invalid index
	 */
	public function test_get_throwsOutOfBoundsException_ifOffsetIsInvalidIndex()
	{
		$this->setExpectedException('OutOfBoundsException');
		
		(new Quantitative())->get(999);
		
		return;
	}
	
	/**
	 * get() should throw an InvalidArgumentException if $offset is invalid string
	 */
	public function test_get_throwsInvalidArgumentException_ifOffsetIsInvalidString()
	{
		$this->setExpectedException('InvalidArgumentException');
		
		(new Quantitative())->get('foo');
		
		return;	
	}
	
	/**
	 * get() should return string if $offset is valid index
	 */
	public function test_get_returnsString_ifOffsetIsValidIndex()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(2, $sample->get(1));
		
		return;
	}
	
	/**
	 * get() should return string if $offset is valid string
	 */
	public function test_get_returnsString_ifOffsetIsValidString()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->get('first'));
		$this->assertEquals(3, $sample->get('last'));
		
		return;
	}
	
	
	/* !getObservations() */
	
	/**
	 * getObservations() should return an array if observations do not exist
	 */
	public function test_getObservations_returnsArray_ifObservationsDoNotExist()
	{
		return $this->assertEquals([], (new Quantitative())->getObservations());
	
	}
	
	/**
	 * getObservations() should return an array if observations do exist
	 */
	public function test_getObservations_returnsArray_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		return $this->assertEquals($observations, $sample->getObservations());
	}
	
	
	/* !max() */
	
	/**
	 * max() should return null if observations do not exist
	 */
	public function test_max_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->max());
	}
	
	/**
	 * max() should return number if observations do exist
	 */
	public function test_max_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(3, $sample->max());
		
		return;	
	}
	
	
	/* !mean() */
	
	/**
	 * mean() should return null if observations do not exist
	 */
	public function test_mean_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->mean());
	}
	
	/**
	 * mean() should return null if observations do exist
	 */
	public function test_mean_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(2, $sample->mean());
		
		return;
	}
	
	
	/* !median() */
	
	/**
	 * median() should return null if observations do not exist
	 */
	public function test_median_returnsNull_ifZeroObservationsExist()
	{
		return $this->assertNull((new Quantitative())->median());
	}
	
	/**
	 * median() should return null if one observation exists
	 */
	public function test_median_returnsNull_ifOneObservationExists()
	{
		return $this->assertNull((new Quantitative())->median());
	}
	
	/**
	 * median() should return number if even observations exist
	 */
	public function test_median_returnsNumber_ifEvenObservationsExist()
	{
		$observations = [1, 4, 5, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(3.5, $sample->median());
		
		return;
	}
	
	/**
	 * median() should return number if odd observations exist
	 */
	public function test_median_returnsNumber_ifOddObservationsExist()
	{
		$observations = [1, 4, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(3, $sample->median());
		
		return;
	}
	
	
	/* !min() */
	
	/**
	 * min() should return null if observations do not exist
	 */
	public function test_min_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->min());
	}
	
	/**
	 * min() should return number if observations do exist
	 */
	public function test_min_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->min());
		
		return;	
	}
	
	
	/* !mode() */
	
	/**
	 * mode() should return null if observations do not exist
	 */
	public function test_mode_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->mode());
	}
	
	/**
	 * mode() should return number if frequencies are equal
	 */
	public function test_mode_returnsNumber_ifFrequenciesAreEqual()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertTrue(in_array($sample->mode(), $observations));
		
		return;
	}
	
	/**
	 * mode() should return number if frequencies are not equal
	 */
	public function test_mode_returnsNumber_ifFrequenciesAreNotEqual()
	{
		$observations = [1, 2, 3, 1];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->mode());
		
		return;
	}
	
	
	/* !n() */
	
	/**
	 * n() should return int if observations do not exist
	 */
	public function test_n_returnsInt_ifObservationsDoNotExist()
	{
		return $this->assertEquals(0, (new Quantitative())->n());
	}
	
	/**
	 * n() should return int if observations do exist
	 */
	public function test_n_returnsInt_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
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
		$sample = new Quantitative();
		
		$this->assertSame($sample, $sample->prepend(1));
		$this->assertEquals(1, $sample->n());
		$this->assertEquals(1, $sample->get('first'));
		
		return;
	}
	
	/**
	 * prepend() should prepend observation and return self if observations do exist
	 */
	public function test_prepend_returnsSelf_ifObservationsDoExist()
	{
		$sample = new Quantitative();
		
		$sample->setObservations([2, 3]);
		
		$this->assertSame($sample, $sample->prepend(1));
		$this->assertEquals(3, $sample->n());
		$this->assertEquals(1, $sample->get('first'));
		
		return;
	}
	
	
	/* !product() */
	
	/**
	 * product() should return null if observations do not exist
	 */
	public function test_product_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->product());
	}
	
	/**
	 * product() should return number if observations do exist
	 */
	public function test_product_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(6, $sample->product());
		
		return;
	}
	
	
	/* !pop() */
	
	/**
	 * pop() should return null if observations do not exist
	 */
	public function test_pop_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->pop());
	}
	
	/**
	 * pop() should return string if observations do exist
	 */
	public function test_pop_returnsString_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(3, $sample->pop());
		$this->assertEquals(2, $sample->n());
		
		return;
	}
	
	
	/* !shift() */
	
	/**
	 * shift() should return null if observations do not exist
	 */
	public function test_shift_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->shift());
	}
	
	/**
	 * shift() should return string if observations do exist
	 */
	public function test_shift_returnsString_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->shift());
		$this->assertEquals(2, $sample->n());
		
		return;
	}
	
	
	/* !sum() */
	
	/**
	 * sum() should return null if observations do not exist
	 */
	public function test_sum_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->sum());
	}
	
	/**
	 * sum() should return number if observations do exist
	 */
	public function test_sum_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(6, $sample->sum());
		
		return;
	}
	
	
	/* !sumSquares() */
	
	/**
	 * sumSquares() should return null if observations do not exist
	 */
	public function test_sumSquares_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->sumSquares());
	}
	
	/**
	 * sumSquares() should return number if observations do exist
	 */
	public function test_sumSquares_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(2, $sample->sumSquares());
		
		return;
	}
	
	
	/* !setObservations() */
	
	/**
	 * setObservations() should return self if $observations is an array
	 */
	public function test_setObservations()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		
		$this->assertSame($sample, $sample->setObservations($observations));
		$this->assertEquals($observations, $sample->getObservations());
		
		return;
	}
	
	
	/* !variance() */
	
	/**
	 * variance() should return null if observations do not exist
	 */
	public function test_variance_returnsNull_ifObservationsDoNotExist()
	{
		return $this->assertNull((new Quantitative())->variance());
	}
	
	/**
	 * variance() should return number if observations do exist
	 */
	public function test_variance_returnsNumber_ifObservationsDoExist()
	{
		$observations = [1, 2, 3];
		
		$sample = new Quantitative();
		$sample->setObservations($observations);
		
		$this->assertEquals(1, $sample->variance());
		
		return;
	}
}
