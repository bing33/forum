<?php

function create( $class, $attributes = [] ){
    return factory( $class )->create( $attributes );
}

function make( $class, $attribute = [] ){
    return factory( $class )->make( $attribute );
}