<?php

use Core\Container;

test('it can resolved somthing out for container', function () {
    // arrange
    $container =  new Container();
    $container->bind('foo', fn () => 'bar');
    // act
    $result = $container->resolve('foo');
    // assert/except

    expect($result)->toEqual('barx');
});
