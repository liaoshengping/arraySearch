<h1 align="center">A simple  Array search and array paging </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require liaosp/array-search -vvv
```

## Usage

example：

```php
$target = [
    [
        'id'=>1,
        'status'=>3
        ],
    [
        'id'=>2,
        'status'=>1
    ],
    [
        'id'=>3,
        'status'=>2
    ],
    [
        'id'=>4,
        'status'=>1
    ],
    [
        'id'=>5,
        'status'=>1
    ],
    [
        'id'=>6,
        'status'=>1
    ],

];
```

```
$obj = new ArraySearch();

$data = $obj->arrayData($target)->paginate(1);//firstPageData  ，第一页数据。

```

where：

```
$data = $obj->arrayData($target)->where(['status'=>1])->paginate(1);//firstPageData  ，第一页数据。
```
whereIn:

```
$data = $obj->arrayData($target)->whereIn(['status'=>[1,2]])->paginate(1);//firstPageData  ，第一页数据。
```

orWhere:

```
$data = $obj->arrayData($target)->orWhere(['status'=>1,'id'=>1])->paginate(1);//firstPageData  ，第一页数据。
```
notWhere:

```
$data = $obj->arrayData($target)->notWhere(['status'=>1,'id'=>1])->paginate(1);//firstPageData  ，第一页数据。
```



## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/liaoshengping/arraySearch/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/liaoshengping/arraySearch/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT