<?php


return array(



'multi' => array(

    'adminlogin' => array(
            'driver' => 'eloquent',
            'model' => 'Admin',
            'table' => 'tbl_admin'
        ),
        
		'userlogin' => array(
             'driver' => 'eloquent',
             'model' => 'User',
             'table' => 'tbl_user',

        ),
     'ownerlogin' => array(
            'driver' => 'eloquent',
            'model' => 'Admin',
            'table' => 'tbl_admin'
     )   
        
),

    'reminder' => array(

        'email' => 'emails.auth.reminder',

        'table' => 'password_reminders',

        'expire' => 60,

    ),

);
