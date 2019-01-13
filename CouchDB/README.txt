Move the Couchdb.php file to your libraries folder. This is usually in a path
like root_dir}/application/libraries/Couchdb.php

Please note that you are not change the file name "Couchdb" something fancy
like "CouchDB". It will not work and if it somehow does, it will have 
undesirable behaviours.


Add lines 14-21 to the bottom of your config.php file. You will find this file 
in the path like {root_dir}/application/config/config.php

Supported protocols are HTTP and HTTPS.

$config['couchdb'] = array(
    'protocol' => 'http',
    'domain' => '127.0.0.1',
    'port' => "5984",
    'db_name' => 'DATABASE_NAME_HERE',            
    'authorization' => array("authorization: AUTHORIZATION_VALUE_HERE")
);

Lastly, load the library for use by adding the line 16 to your controller.

$this->load->library('couchdb', $this->config->item('couchdb'));

Voila! You're all good to go. Happy coding!
