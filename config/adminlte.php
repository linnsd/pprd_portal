<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'PPRD',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Admin</b>',

    'logo_mini' => '<b>A</b>LT',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple-light',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text'        => 'Dashboard',
            'url'         => 'admin/home',
            'icon'        => 'dashboard',
            // 'label'       => 4,
            // 'label_color' => 'success',
            'permission'=>'dashboard'
        ],

        // [
        //     'text'        => 'အရောင်းဆိုင်များ',
        //     'url'         => 'admin/shops',
        //     'icon'        => 'building',
        //     // 'label'       => 4, 
        //     // 'label_color' => 'success',
        //     'permission'=>'shop-list'
        //     'submenu' => [
        //         [
        //             'text' => 'စက်သုံးဆီအရောင်းဆိုင်',
        //             'url'  => 'admin/licence_gp',
        //             'permission'=>'township-list',
        //             'icon' => 'fas fa-bars',
        //         ],
        //         [
        //             'text' => 'ကျေးရွာသုံးစက်သုံးဆီအရောင်းဆိုင်',
        //             'url'  => 'admin/licence_gp',
        //             'permission'=>'township-list',
        //             'icon' => 'fas fa-bars',
        //         ],
        //     ]
        // ],

        // [
        //     'text' => 'အရောင်းဆိုင်များ', 
        //     // 'url' => 'admin/shops',
        //     'icon' => 'building',
        //     'permission'=>'shop-list',
        //     'submenu' => [
        //         [
        //             'text' => 'စက်သုံးဆီအရောင်းဆိုင်',
        //             'url'  => 'admin/machine_oil',
        //             'permission'=>'township-list',
        //             'icon' => 'building',
        //         ],
        //         [
        //             'text' => 'ကျေးရွာသုံးစက်သုံးဆီအရောင်းဆိုင်',
        //             'url'  => 'admin/village_shop',
        //             'permission'=>'township-list',
        //             'icon' => 'building',
        //         ],
       
        //         [
        //             'text' => 'လေယာဉ်ဆီ',
        //             'url'  => 'admin/airport_oil',
        //             'permission'=>'township-list',
        //             'icon' => 'building',
        //         ],
                
        //     ]
        // ],
        // [
        //     'text'        => 'ယာဉ်များ',
        //     'url'         => 'admin/cars',
        //     'icon'        => 'car',
        //     // 'label'       => 4,
        //     // 'label_color' => 'success',
        //     'permission'=>'car-list'
        // ],

        
        [
            'text'        => 'My Shop',
            'url'         => 'admin/myshop',
            'icon'        => 'building',
            // 'label'       => 4,
            // 'label_color' => 'success',
             'permission'=>'my-shop-list'
        ],
        [
            'text'        => 'Signage',
            'url'         => '/admin/signage',
            'icon'        => 'credit-card',
            // 'label'       => 4,
            // 'label_color' => 'success',
             'permission'=>'signage-show'
        ],

        

        'အရောင်းဆိုင်များ',
        [
            'text'        => 'ဆီဆိုင်များ',
            'url'         => 'admin/fuel_shops',
            'icon'        => 'building',
            'permission'=>'shop-list'
        ],
        [
            'text'        => 'ဆီဆိုင်သိုလှောင်နိုင်မှု',
            'url'         => 'admin/shop_fuel_capacity',
            'icon'        => 'building',
            'permission'=>'shop-list'
        ],

        [
            'text'        => 'ကြိုတင်မှာယူမှုမှတ်တမ်း',
            'url'         => 'admin/pre_shops',
            'icon'        => 'history',
            'permission'=>'shop-list'
        ],

        [
            'text'        => 'နေ့စဉ်မှတ်တမ်း',
            'url'         => 'admin/daily_shop_reports',
            'icon'        => 'history',
            'permission'=>'shop-list'
        ],

        [
            'text'        => 'Report မတင်ရသေးသောဆိုင်များ',
            'url'         => 'admin/no_report_shops',
            'icon'        => 'history',
            'permission'=>'shop-list'
        ],

        'Report',

        [
            'text'        => 'Main Shop Report',
            'url'         => 'admin/main_shop_report',
            'icon'        => 'building',
            'permission'=>'shop-list'
        ],

        'MASTER DATA',
        [
            'text'        => 'တိုင်းဒေသကြီး',
            'url'         => 'admin/states-divisons',
            'icon'        => 'list',
            // 'label'       => 4,
            // 'label_color' => 'success',
            'permission'=>'state-division-list'
        ],
        [
            'text' => 'မြို့နယ်များ',
            'url' => 'admin/township',
            'icon' => 'map',
            // 'label'       => 4,
            // 'label_color' => 'success',
             'permission'=>'township-list'
        ],
        [
            'text' => 'ဆီအမျိုးအစားများ',
            'url' => 'admin/fuel_types',
            'icon' => 'product-hunt',
             'permission'=>'township-list'
        ],

        [
            'text' => 'Report Time',
            'url' => 'admin/report_times',
            'icon' => 'clock-o',
            'permission'=>'township-list'
        ],
        [
            'text' => 'သိုလှောင်ကန်စခန်း',
            'url'  => 'admin/terminal',
            'permission'=>'township-list',
            'icon' => 'building',
        ],

        [
            'text' => 'Notification',
            'url' => 'admin/notifications',
            'icon' => 'bell',
            'permission'=>'township-list'
        ],



        
        
        [
            'text' => 'လိုင်စင်များ', 
            'url' => 'admin/licence',
            'icon' => 'drivers-license',
            'permission'=>'township-list',
            'submenu' => [
                [
                    'text' => 'Licence Group',
                    'url'  => 'admin/licence_gp',
                    'permission'=>'township-list',
                    'icon' => 'fas fa-bars',
                ],
                [
                    'text' => 'Sub Licence Group',
                    'url'  => 'admin/sub_lic_gp',
                    'permission'=>'township-list',
                    'icon' => 'certificate',
                ],
                [
                    'text' => 'Licence',
                    'url'  => 'admin/licence_name',
                    'permission'=>'township-list',
                    'icon' => 'certificate',
                ],
                [
                    'text' => 'Licence Fee',
                    'url'  => 'admin/licence_fee',
                    'permission'=>'township-list',
                    'icon' => 'money',
                ],
                [
                    'text' => 'Licence Grade',
                    'url'  => 'admin/licence_grade',
                    'permission'=>'township-list',
                    'icon' => 'fa fa-fw fas fa-layer-group',
                ],
                
            ]
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Login Users',
            'url' => 'admin/users',
            'icon' => 'users',
            'permission'=>'user-list'
        ],
        [
            'text' => 'User Role',
            'url' => 'admin/roles',
            'icon' => 'cog',
            'permission'=>'role-list'
        ],
        [
            'text' => 'Profile',
            'url' => 'admin/profile',
            'icon' => 'user',
            'permission'=>'profile'
        ],
        [
            'text' => 'Change Password',
            'url' => 'admin/password/change',
            'icon' => 'lock',
            'permission'=>'change-password'
        ],
        ['header' => 'System Setting'],
        [
            'text' => 'Backup',
            'url'  => 'admin/backup',
            'icon' => 'database',
            'permission'=>'backup-list'
        ],
        [
            'text' => 'Activity Logs',
            'url'  => 'admin/logs',
            'icon' => 'bug',
            'permission'=>'logs-list'
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
