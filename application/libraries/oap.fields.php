<?php
$filter_operation=array(
	'e' => 'Equal to', 
	'n' => 'Not equal to', 
	's' => 'Starts with ',  
	'c' => 'Like',  
	'k' => 'Not Like',  
	'l' => 'Less than',  
	'g' => 'Greater Than',  
	'm' => 'Less Than or Equal to',  
	'h' => 'Greater Than or Equal to' 
);
$active_fields=array('Contact Information','Contact Attributes','Contact System Attributes','Lead Information','Sequences and Tags','Affiliate Data','Transaction Info','Credit Card','Social Engine Membership Options');
$user_fieldlist=
Array
(
    'Contact Information' => Array
        (
            0  => array('field'=>'Subscriber/Customer #',                          'read'=>true,'write'=>false,'show'=>false,'type'=>'text'),
            1  => array('field'=>''                     ,                          'read'=>true,'write'=>true, 'show'=>false, 'type'=>'text'),
            2  => array('field'=>'Company'              ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            3  => array('field'=>'Title'                ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            4  => array('field'=>'Salutation'           ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            5  => array('field'=>'First Name'           ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            6  => array('field'=>'Middle Name'          ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            7  => array('field'=>'Last Name'            ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            8  => array('field'=>'Name Suffix'          ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            9  => array('field'=>'Address'              ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            10 => array('field'=>'Address 2'            ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            11 => array('field'=>'Address 3'            ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            12 => array('field'=>'City'                 ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            13 => array('field'=>'State'                ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            14 => array('field'=>'Zip Code'             ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'zip'),
            15 => array('field'=>'Country'              ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text'),
            16 => array('field'=>'E-Mail'               ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'email'),
            17 => array('field'=>'Primary Phone'        ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'tel'),
            18 => array('field'=>'Home Phone'           ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'tel'),
            19 => array('field'=>'Cell Phone'           ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'tel'),
            20 => array('field'=>'Office Phone'         ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'tel'),
            21 => array('field'=>'Extension Number'     ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'number'),
            22 => array('field'=>'Fax'                  ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'tel'),
            23 => array('field'=>'Website'              ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'url'),
            24 =>array('field'=> 'Birthday'             ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'datetime'),
            25 => array('field'=>'Gender'               ,                          'read'=>true,'write'=>true, 'show'=>true,  'type'=>'text')
        ),

    'Contact Attributes' => Array
        (
            0 => array('field'=>'Contact Customer Type Code',                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Phone Flag',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Mail Flag',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Email Flag',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Rent Phone',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Rent Mail',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            6 => array('field'=>'Rent Email',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            7 => array('field'=>'Hold Code',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            8 => array('field'=>'Warehouse Code',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            9 => array('field'=>'Default Ship Via Code',                           'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            10 => array('field'=>'Default Payment Terms Code',                     'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            11 =>array('field'=> 'Site Password',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            12 => array('field'=>'Insider Password',                               'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            13 => array('field'=>'Club X Password',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            14 => array('field'=>'Club Y Password',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            15 => array('field'=>'Credit Limit',                                   'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            16 => array('field'=>'Tax Code',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            17 => array('field'=>'Tax Authority Name',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            18 => array('field'=>'Tax Exempt Number',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            19 =>array('field'=> 'Customer Sales Rep',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            20 => array('field'=>'Customer Area Rep',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            21 => array('field'=>'Sales Contact Name',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            22 =>array('field'=> 'Billing Address Owner',                          'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            23 => array('field'=>'Shipping Address Owner',                         'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),

    'Contact System Attributes' => Array
        (
            0 => array('field'=>'Credit Reviewed Date',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Average Days to Pay',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Original Promo Code',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Statement Cycle Code',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'First Key Code Ordered',                          'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Last Key Code Ordered',                           'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            6 => array('field'=>'First Order Date',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            7 => array('field'=>'Last Order Date',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            8 => array('field'=>'Total Orders',                                    'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            9 => array('field'=>'Units Returned',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            10 => array('field'=>'Receivable Amount',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            11 => array('field'=>'Dollars Returned',                               'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            12 => array('field'=>'Account Open Date',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
        ),

    'Lead Information' => Array
        (
            0 => array('field'=>'Contact Owner',                                   'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Personal Development',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Favorite Color',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'First Referrer',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Last Referrer',                                   'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Current Income',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            6 => array('field'=>'Personal Profile Background Information',         'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            7 => array('field'=>'Unsubscribe Date',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            8 => array('field'=>'Lead Source',                                     'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            9 => array('field'=>'Campaign',                                        'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            10 => array('field'=>'Ad',                                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            11 => array('field'=>'Media',                                          'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),

    'Sequences and Tags' => Array
        (
            0 => array('field'=>'Sequences',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Contact Tags',                                    'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Opt in/Opt out',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'MQOD Sign Up',                                    'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Groupon-MQOD Sub',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Follow-up',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),

    'Affiliate Data' => Array
        (
            0 => array('field'=>'Affiliate Program',                               'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'First Name',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'SS# / Corp ID# / ABN',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Make Payment To',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Make Payment To',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Payment Method',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            6 => array('field'=>'Website 1',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            7 => array('field'=>'Site Description',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            8 => array('field'=>'Site Views/Month',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            9 => array('field'=>'Select Currency',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            10 => array('field'=>'Site Type',                                      'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            11 => array('field'=>'Category 1',                                     'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            12 => array('field'=>'Agreement Textbox',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
          //  13 => array('field'=>'',                                               'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            14 => array('field'=>'Number of Sales',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            15 =>array('field'=> '$ Sales',                                        'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            16 => array('field'=>'Paypal Address',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),

    'Transaction Info' => Array
        (
            0 => array('field'=>'Last Invoice #',                                  'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Last Total Invoice Amount',                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Last Charge Amount',                              'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Total $ Unpaid Transactions',                     'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),

    'Credit Card' => Array
        (
            0 => array('field'=>'Card Type',                                       'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 => array('field'=>'Card Expiration Month',                           'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Card Expiration Year',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Card Number (Last 4)',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Charge Result',                                   'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Card Expiration Date',                            'read'=>true,'write'=>true,'show'=>true,'type'=>'text')
        ),
		'Social Engine Membership Options'=>array(
            0 =>array('field'=> 'Password',                                        'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            1 =>array('field'=>'Username',                                         'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            2 => array('field'=>'Access Level',                                    'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            3 => array('field'=>'Active Membership',                               'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            4 => array('field'=>'Member Created Date',                             'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            5 => array('field'=>'Number of Posts',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            6 => array('field'=>'Number of Thanks',                                'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
            7 => array('field'=>'Last Login Date',                                 'read'=>true,'write'=>true,'show'=>true,'type'=>'text'),
           
		
		)

)
?>