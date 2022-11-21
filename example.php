<?php 
require_once('webhookclass.php');

// Calling the class.
$zwh = new ZapierWebhook();

// We define the webhook URL.
$zwh->hookUrl = "https://hooks.zapier.com/hooks/catch/xxxxxxxxxx/xxxxxx/";

// Using for plain text
$zh->webhookInitPlainText('Hello Zapier !');

// Using for plain JSON
$zh->webhookInit(array('first_name'=>'Johny','last_name'=>'Bravo'));
