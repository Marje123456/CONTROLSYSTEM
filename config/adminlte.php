<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'Slots | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => 'vendor/adminlte/dist/img/AdminLTELogolarg.png',
    'logo_img_xl_class' => 'brand-image-xl',
    'logo_img_alt' => 'Slots Logo',

    /* 
     'logo' => '<b>SLOTS</b>Management',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Slots Logo',
    */

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogolarg.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 70,
            'height' => 70,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Slots Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
            'mode' => 'cwrapper',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-info',
    'classes_auth_header' => 'd-none',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-info',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-white',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => 'text-info',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-info navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'Buscar',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        /* [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ], */
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            //'can'  => 'manage-blog',
        ],
        [
            'text'    => 'CONFIGURACIÓN',
            'icon'    => 'fas fa-fw fa-solid fa-wrench',
            'icon_color' => 'red',
            //'can' => 'cambio_estatus_maquina',
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'icon' => 'fas fa-fw fa-solid fa-user',
                    'icon_color' => 'red',
                    //'can' => 'gestionar_usuarios',
                    'submenu' => [
                        [
                            'text' => 'Gestionar Usuarios',
                            'route'  => 'usero.index',
                            'icon' => 'fas fa-fw fa-solid fa-user-shield',
                            'icon_color' => 'red',
                            //'can' => 'gestionar_usuarios',
                        ],
                        [
                            'text' => 'Gestionar Roles',
                            'route'  => 'roles.index',
                            'icon' => 'fas fa-fw fa-solid fa-universal-access',
                            'icon_color' => 'red',
                            //'can' => 'configuracion',
                        ],
                        [
                            'text' => 'Gestionar Permisos',
                            'route'  => 'permissions.index',
                            'icon' => 'fas fa-fw fa-lock',
                            'icon_color' => 'red',
                            //'can' => 'configuracion',
                        ],
                    ],
                ],
                [
                    'text' => 'Cambio de Estatus-Máquina',
                    'route'  => 'machine.statusmachine',
                    'icon' => 'fas fa-fw fa-solid fa-cash-register',
                    //'can' => 'cambio_estatus_maquina',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Impuesto por Máquina',
                    'route'  => 'machine.taxmachine',
                    'icon' => 'fas fa-fw fa-solid fa-coins',
                    //'can' => 'cambio_estatus_maquina',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Porcentaje pago a empresa',
                    'route'  => 'box.payporcent',
                    'icon' => 'fas fa-fw fa-solid fa-money-bill',
                    //'can' => 'cambio_estatus_maquina',
                    'icon_color' => 'red',
                ],
                
                [
                    'text' => 'Auditoria',
                    'icon' => 'fas fa-fw fa-solid fa-user-shield',
                    //'can' => 'configuracion',
                    'submenu' => [
                        [
                            'text' => 'Fiscalizar Local',
                            'route'  => 'premise.auditprub',
                            'icon' => 'fas fa-fw fa-solid fa-user-shield',
                            //'can' => 'configuracion',
                        ],
                        /* [
                            'text' => 'Fiscalizar Maquina',
                            'route'  => 'machine.auditprubmachine',
                            'icon' => 'fas fa-fw fa-solid fa-user-shield',
                            
                        ], */
                    ],
                ],
                
                
            ],
        ],
        [
            'text'    => 'GESTIÓN FISCALES',
            'icon'    => 'fas fa-fw fa-solid fa-user-nurse',
            'icon_color' => 'yellow',
            //'can' => 'gestionar_fiscales',
            'submenu' => [
                [
                    'text' => 'Fiscales',
                    'route'  => 'prosecutor.index',
                    'icon_color' => 'yellow',
                    'icon' => 'fas fa-fw fa-solid fa-user-nurse',
                    //'can' => 'fiscal_index',
                ],
                [
                    'text' => 'Crear Ruta',
                    'route'  => 'itinerary.create',
                    'icon' => 'fas fa-fw fa-regular fa-map',
                    'icon_color' => 'yellow',
                    //'can' => 'crear_ruta',
                ],
                [
                    'text' => 'Ver Rutas',
                    'route'  => 'itinerary.index',
                    'icon' => 'fas fa-fw fa-route',
                    'icon_color' => 'yellow',
                    //'can' => 'asignar_ruta',
                ],
                
            ],
        ],
        [
            'text'    => 'REGISTRAR',
            'icon'    => 'fas fa-fw fa-solid fa-plus',
            'icon_color' => 'green',
            //'can' => 'registrar_rlm',
            'submenu' => [
                [
                    'text' => 'Representante',
                    'route'  => 'responsible.create',
                    'icon' => 'fas fa-fw fa-solid fa-user-tie',
                    'icon_color' => 'green',
                ],
            ],
        ],
        [
            'text'    => 'CIERRE',
            'icon'    => 'fas fa-fw fa-solid fa-money-check',
            'icon_color' => 'blue',
            //'can' => 'cierres',
            'submenu' => [
                [
                    'text' => 'Cierre de Caja',
                    'route'  => 'box.create',
                    'icon' => 'fas fa-fw fa-solid fa-money-bill',
                    'icon_color' => 'blue',
                    //'can' => 'cierre_caja',
                ],
                [
                    'text' => 'Cierre Municipalidad',
                    'route'  => 'box.closemunicipality',
                    'icon' => 'fas fa-fw fa-solid fa-landmark',
                    'icon_color' => 'blue',
                    //'can' => 'cierre_municipalidad',
                ],
            ],
        ],
        [
            'text'    => 'REPORTES',
            'icon'    => 'fas fa-fw fa-solid fa-list',
            'icon_color' => 'orange',
            //'can' => 'reportes',
            'submenu' => [
                /* [
                    'text' => 'Responsable-Local-Máquinas',
                    'route'  => 'responsible.reportall',
                    'icon' => 'fas fa-fw fa-regular fa-newspaper',
                    'icon_color' => 'orange',
                    //'can' => 'cierre_municipalidad',
                ], */
                [
                    'text' => 'Cierres de Caja',
                    'route'  => 'box.index',
                    'icon' => 'fas fa-fw fa-solid fa-file-invoice-dollar',
                    'icon_color' => 'orange',
                    //'can' => 'cierre_municipalidad',
                ],
                [
                    'text' => 'Mis Pagos',
                    'route'  => 'responsible.responsiblepayment',
                    'icon' => 'fas fa-fw fa-solid fa-coins',
                    'icon_color' => 'orange',
                    //'can' => 'mis_pagos_responsible',
                ],
                [
                    'text' => 'Mi Recorrido',
                    'route'  => 'prosecutor.myitinerary',
                    'icon' => 'fas fa-fw fa-route',
                    'icon_color' => 'orange',
                    //'can' => 'auditorias',
                ],
                [
                    'text' => 'Representantes',
                    'route'  => 'responsible.index',
                    'icon' => 'fas fa-fw fa-solid fa-user-tie',
                    'icon_color' => 'orange',
                    //'can' => 'reportes_rlm',
                ],
                [
                    'text' => 'Local',
                    'route'  => 'premise.index',
                    'icon' => 'fas fa-solid fa-store',
                    'icon_color' => 'orange',
                    //'can' => 'reportes_rlm',
                ],
                [
                    'text' => 'Máquina',
                    'route'  => 'machine.index',
                    'icon' => 'fas fa-fw fa-solid fa-desktop',
                    'icon_color' => 'orange',
                    //'can' => 'reportes_rlm',
                ],
                [
                    'text' => 'QR con orden de impresión',
                    'route'  => 'machine.qrorders',
                    'icon' => 'fas fa-fw fa-solid fa-qrcode',
                    'icon_color' => 'orange',
                    //'can' => 'maquinas_orden_imp',
                ],
                [
                    'text' => 'Auditorias de Locales',
                    'route'  => 'premise.auditindex',
                    'icon' => 'fas fa-fw fa-regular fa-clipboard',
                    'icon_color' => 'orange',
                    //'can' => 'auditorias',
                ],
                
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'CustomCss' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'css/custom-adminlte.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
