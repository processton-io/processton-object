<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'base_path' => 'objects',
    'menu_items' => [
        [
            "label" => "Objects",
            "slug" => "objects",
            "icon" => "circle",
            "permission" => [],
            "hidden_links" => [
                "objects-new",
                "objects-view",
                "object-edit"
            ]
        ]
    ],
    'interactions' => [
        [
            "slug" => "objects",
            'title' => 'Objects',
            'subtitle' => '',
            'icon' => 'circle',
            "schema" => [
                'breadcrumbs' => [
                    [
                        'label' => 'Dashboard',
                        'slug' => 'dashboard',
                        'icon' => 'pie-chart'
                    ],
                    [
                        'label' => 'Objects',
                        'slug' => 'objects',
                        'icon' => 'circle'
                    ]
                ],

                'header_actions' => [
                    [
                        'type' => 'model',
                        'label' => 'New Object',
                        'icon' => 'plus',
                        'color' => 'primary',
                        'permission' => [],
                        'action' => '/objects/new'
                    ]
                ],
                'filters' => [
                    [
                        'type' => 'date_range',
                        'label' => 'Date Range',
                        'key' => 'date_range',
                        'value' => '2021-01-01,2021-12-31',
                        'format' => 'YYYY-MM-DD',
                        'placeholder' => 'Select Date Range',
                        'options' => [
                            'today' => 'Today',
                            'yesterday' => 'Yesterday',
                            'this_week' => 'This Week',
                            'last_week' => 'Last Week',
                            'this_month' => 'This Month',
                            'last_month' => 'Last Month',
                            'this_year' => 'This Year',
                            'last_year' => 'Last Year',
                            'custom' => 'Custom'
                        ],
                        'default' => 'this_month'
                    ]
                ],
                'elements' => [
                    [
                        'type' => 'data_table',
                        'name' => 'Objects List',
                        'title' => 'Objects List',
                        'subtitle' => '',
                        'attachment' => [],
                        'permissions' => [],
                        'srcOfData' => [
                            'api_endpoint' => '/objects/list',
                        ],
                        'data' => [],
                        'width' => [
                            'xxxs' => 12,
                            'xxs' => 12,
                            'xs' => 12,
                            'sm' => 12,
                            'md' => 12,
                            'lg' => 12,
                            'xl' => 12,
                            'xxl' => 12,
                            'xxxl' => 12,
                        ],
                        'elements' => [],
                    ],
                ],
            ]
        ],
        [
            "slug" => "object-new",
            'title' => 'New Object',
            'subtitle' => '',
            'attachments' => [
            ],
            'icon' => 'circle',
            "schema" => [
                'breadcrumbs' => [
                    [
                        'label' => 'Dashboard',
                        'slug' => 'dashboard',
                        'icon' => 'pie-chart'
                    ],
                    [
                        'label' => 'Objects',
                        'slug' => 'objects',
                        'icon' => 'circle'
                    ],
                    [
                        'label' => 'New Object',
                        'slug' => '',
                        'icon' => 'plus'
                    ]
                ],
                'filters' => [],
                'elements' => [
                    [
                        'type' => 'row',
                        'width' => [
                            'xxxs' => 12,
                            'xxs' => 12,
                            'xs' => 12,
                            'sm' => 12,
                            'md' => 12,
                            'lg' => 12,
                            'xl' => 12,
                            'xxl' => 12,
                            'xxxl' => 12,
                        ],
                        'elements' => [
                            [
                                'type' => 'form',
                                'title' => 'New Object',
                                'srcOfData' => [
                                    'api_endpoint' => '/objects/new',
                                    'attachments' => [
                                    ],
                                ],
                                'width' => [
                                    'xxxs' => 12,
                                    'xxs' => 12,
                                    'xs' => 12,
                                    'sm' => 12,
                                    'md' => 12,
                                    'lg' => 12,
                                    'xl' => 12,
                                    'xxl' => 12,
                                    'xxxl' => 12,
                                ],
                                'elements' => []
                            ]
                        ]
                    ]
                ],
            ]
        ],
        [
            "slug" => "object-edit",
            'title' => 'Edit Object',
            'subtitle' => '',
            'attachments' => [
                [
                    'key' => 'id',
                    'value' => 'id'
                ]
            ],
            'icon' => 'circle',
            "schema" => [
                'breadcrumbs' => [
                    [
                        'label' => 'Dashboard',
                        'slug' => 'dashboard',
                        'icon' => 'pie-chart'
                    ],
                    [
                        'label' => 'Objects',
                        'slug' => 'objects',
                        'icon' => 'circle'
                    ],
                    [
                        'label' => 'Edit Object',
                        'slug' => '',
                        'icon' => 'edit'
                    ]
                ],
                'filters' => [
                    [
                        'type' => 'date_range',
                        'label' => 'Date Range',
                        'key' => 'date_range',
                        'value' => '2021-01-01,2021-12-31',
                        'format' => 'YYYY-MM-DD',
                        'placeholder' => 'Select Date Range',
                        'options' => [
                            'today' => 'Today',
                            'yesterday' => 'Yesterday',
                            'this_week' => 'This Week',
                            'last_week' => 'Last Week',
                            'this_month' => 'This Month',
                            'last_month' => 'Last Month',
                            'this_year' => 'This Year',
                            'last_year' => 'Last Year',
                            'custom' => 'Custom'
                        ],
                        'default' => 'this_month'
                    ]
                ],
                'elements' => [
                    [
                        'type' => 'row',
                        'width' => [
                            'xxxs' => 12,
                            'xxs' => 12,
                            'xs' => 12,
                            'sm' => 12,
                            'md' => 12,
                            'lg' => 12,
                            'xl' => 12,
                            'xxl' => 12,
                            'xxxl' => 12,
                        ],
                        'elements' => [
                            [
                                'type' => 'form',
                                'title' => 'Edit Object',
                                'srcOfData' => [
                                    'api_endpoint' => '/objects/edit',
                                    'attachments' => [
                                        [
                                            'key' => 'id',
                                            'value' => 'id'
                                        ]
                                    ],
                                ],
                                'width' => [
                                    'xxxs' => 12,
                                    'xxs' => 12,
                                    'xs' => 12,
                                    'sm' => 12,
                                    'md' => 12,
                                    'lg' => 12,
                                    'xl' => 12,
                                    'xxl' => 12,
                                    'xxxl' => 12,
                                ],
                                'elements' => []
                            ]
                        ]
                    ]
                ],
            ]
        ],
    ],

    'charts' => [
        'stats' => [
            'total_objects' => [
                'type' => 'stats_card',
                'title' => 'Objects',
                'srcOfData' => [
                    'api_endpoint' => '/objects/stats/count',
                ],
                'width' => [
                    'xxxs' => 12,
                    'xxs' => 12,
                    'xs' => 12,
                    'sm' => 12,
                    'md' => 6,
                    'lg' => 4,
                    'xl' => 4,
                    'xxl' => 4,
                    'xxxl' => 4,
                ],
            ],
            'records_count' => [
                'type' => 'stats_card',
                'title' => 'Records Count',
                'srcOfData' => [
                    'api_endpoint' => '/objects/stats/record-count',
                ],
                'width' => [
                    'xxxs' => 12,
                    'xxs' => 12,
                    'xs' => 12,
                    'sm' => 12,
                    'md' => 6,
                    'lg' => 4,
                    'xl' => 4,
                    'xxl' => 4,
                    'xxxl' => 4,
                ],
            ],
            'size_in_mb' => [
                'type' => 'stats_card',
                'title' => 'Size In MB',
                'format' => true,
                'srcOfData' => [
                    'api_endpoint' => '/objects/stats/size-in-mb',
                ],
                'width' => [
                    'xxxs' => 12,
                    'xxs' => 12,
                    'xs' => 12,
                    'sm' => 12,
                    'md' => 12,
                    'lg' => 4,
                    'xl' => 4,
                    'xxl' => 4,
                    'xxxl' => 4,
                ],
            ],
        ]
    ],

    'resolvers' => []
];