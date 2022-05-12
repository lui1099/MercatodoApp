<?php

return [
    'fields' => [
        'name' => 'Nombre',
        'brand' => 'Marca del producto',
        'price' => 'Precio en COP',
        'category' => 'Categoría',
        'description' => 'Descripciòn del producto',
        'stock' => 'Stock',
        'available' => 'Disponibles',
        'reference' => 'Referencia',

    ],

    'cascade' => [
        'food' => 'Comida y Bebidas',
        'health&pc' => 'Salud y Cuidado Personal',
        'cleaning' => 'Limpieza',

    ],

    'buttons' => [
        'submit' => 'Crear Producto',
    ],



];

