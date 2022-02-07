<?php

class ProductsController
{
    public static function show($item, $value)
    {
        $table = 'products';
        $response = ProductModel::showProducts($table, $item, $value);

        return $response;
    }
}