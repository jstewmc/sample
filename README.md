# Sample
A statistical sample in PHP.

```php
use Jstewmc\Sample;

// create sample's data
$data = [1, 2, 2, 3];

// create sample
$sample = new Quantitative($data);

// echo the sample's descriptive statistics
echo "n: ".$sample->n()."\n";
echo "max: ".$sample->max()."\n";
echo "min: ".$sample->min()."\n";
echo "range: ".$sample->range()."\n"; 
echo "mean: ".$sample->mean()."\n";
echo "median: ".$sample->median()."\n";
echo "mode: ".$sample->mode()."\n";
echo "sum: ".$sample->sum()."\n";
echo "product: ".$sample->product()."\n";
echo "sum squares: ".$sample->sumSquares()."\n";
echo "variance: ".$sample->variance()."\n";
echo "deviation: ".$sample->deviation() ."\n";
```

The example above would produce the following output:

``` 
n: 4
max: 3
min: 1
range: 2
mean: 2
median: 2
mode: 2
sum: 8
product: 12
sum squares: 2
variance: 0.3333
deviation: 0.5774
```

### Statistics

This library supports two types of samples: a *quantitative* sample of numbers like `[1, 2, 3]` and a *qualitative* sample of strings like `['foo', 'bar', 'baz']`. 

However, the *quantitative* sample provides many more descriptive statistics than the *qualitative* sample:

Statistic   | Quantitative | Qualitative
--------------------------------------
n           | Yes          | Yes
max         | Yes          | No
min         | Yes          | No
range       | Yes          | No
mean        | Yes          | No
median      | Yes          | No
mode        | Yes          | Yes
sum         | Yes          | No
product     | Yes          | No
sum squares | Yes          | No
variance    | Yes          | No
deviation   | Yes          | No


## Author

Jack Clayton [clayjs0@gmail.com](mailto:clayjs0@gmail.com)


## Version

### 0.1.0 - August 17, 2015

* Initial release


## License

This library is released under the [MIT license](https://github.com/jstewmc/sample/blob/master/LICENSE).







