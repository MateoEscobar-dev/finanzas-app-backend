<?php

$permissions = ["add", "edit", "destroy", "activate", "historial"];

return [
    [
        'section' => 'permissions',
        'roles' => ["Administrator"],
        'permissions' => [],
        'level' => 1,
        'parent' => '',
        'extra_permissions' => []
    ],
    [
        'section' => 'roles',
        'roles' => ["Administrator"],
        'permissions' => $permissions,
        'level' => 2,
        'parent' => 'permissions',
        'extra_permissions' => ["add_permission"]
    ],
    [
        'section' => 'system',
        'roles' => ["Administrator", "Partner"],
        'permissions' => [],
        'level' => 1,
        'parent' => '',
        'extra_permissions' => []
    ],
    [
        'section' => 'configuration',
        'roles' => ["Administrator", "Partner"],
        'permissions' => [],
        'level' => 2,
        'parent' => 'system',
        'extra_permissions' => []
    ],
    [
        'section' => 'users',
        'roles' => ["Administrator"],
        'permissions' => $permissions,
        'level' => 3,
        'parent' => 'system',
        'before' => 'configuration',
        'extra_permissions' => []
    ],

    // 4
];
