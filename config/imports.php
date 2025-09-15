<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Import Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for Excel imports
    |
    */

    'column_mappings' => [
        'pedidos' => [
            'old_format' => [
                'orderId' => 3,           // Column D
                'customerName' => 4,      // Column E
                'customerNumber' => 5,    // Column F
                'prize' => 8,             // Column I
                'paymentMethod' => 10,    // Column K
                'productionStatus' => 12, // Column M
                'deliveryDate' => 13,     // Column N
                'doctorName' => 15,       // Column P
                'district' => 16,         // Column Q
                'address' => 17,          // Column R
                'reference' => 18,        // Column S
                'userName' => 19,         // Column T
                'createdAt' => 20,        // Column U
            ]
        ],
        
        'detail_pedidos' => [
            'new_format' => [
                'numero' => 0,      // Column A - Numero de pedido
                'articulo' => 1,    // Column B - Articulo
                'cantidad' => 2,    // Column C - Cantidad
                'precio' => 3,      // Column D - Precio unitario
                'subtotal' => 4,    // Column E - Sub total
                'fecha' => 21,      // Column V - Fecha (if exists)
            ],
            'old_format' => [
                'numero' => 3,      // Column D - Pedido ID
                'articulo' => 16,   // Column Q - Articulo
                'cantidad' => 17,   // Column R - Cantidad
                'precio' => 18,     // Column S - Precio unitario
                'subtotal' => 19,   // Column T - Sub total
                'fecha' => 21,      // Column V - Fecha
            ]
        ],
        
        'doctores' => [
            'default' => [
                'name' => 2,              // Column C - Doctor name
                'CMP' => 3,               // Column D - CMP number
                'phone' => 4,             // Column E - Phone
                'name_secretariat' => 7,  // Column H - Secretary name
                'observations' => 8,      // Column I - Observations
                'especialidad' => 9,      // Column J - Especialidad
                'district_info' => 11,    // Column L - District info
                'centro_salud' => 12,     // Column M - Centro de salud
                'categoria_medico' => 15, // Column P - Categoria medico
                'tipo_medico' => 16,      // Column Q - Tipo medico
                'lunes' => 21,           // Column V - Monday
                'martes' => 22,          // Column W - Tuesday
                'miercoles' => 23,       // Column X - Wednesday
                'jueves' => 24,          // Column Y - Thursday
                'viernes' => 25,         // Column Z - Friday
            ]
        ]
    ],

    'validation' => [
        'required_fields' => [
            'pedidos' => ['orderId', 'customerName', 'deliveryDate'],
            'detail_pedidos' => ['numero', 'articulo', 'cantidad'],
            'doctores' => ['name', 'CMP', 'centro_salud']
        ],
        
        'header_keywords' => [
            'pedidos' => ['pedido', 'order', 'numero', 'customer'],
            'detail_pedidos' => ['numero', 'articulo', 'cantidad', 'precio'],
            'doctores' => ['doctor', 'medico', 'nombre', 'cmp']
        ]
    ],

    'district_normalizations' => [
        "CERCADO DE LIMA" => "LIMA",
        "SURCO" => "SANTIAGO DE SURCO",
        "ATE " => "ATE",
        "MAGDALENA" => "MAGDALENA DEL MAR",
        "BREÃ'A" => "BREÑA",
        "BREÃ'A " => "BREÑA",
        "ZARATE" => "SAN JUAN DE LURIGANCHO",
    ],

    'production_status_mapping' => [
        'PENDIENTE' => 0,
        'APROBADO' => 1,
        'PREPARADO' => 1,
        'EN_PREPARACION' => 1,
    ],

    'default_values' => [
        'doctores' => [
            'categoria_medico' => 'Visitador',
            'tipo_medico' => 'En Proceso',
            'asignado_consultorio' => 0,
            'categoriadoctor_id' => 5,
        ],
        'pedidos' => [
            'paymentStatus' => 'PENDIENTE',
            'deliveryStatus' => 'Pendiente',
            'accountingStatus' => 0,
            'turno' => 0,
        ]
    ]
];
