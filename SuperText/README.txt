Move the Supertext.php file to your libraries folder. This is usually in a path
like root_dir}/application/libraries/Supertext.php

Please note that you are not change the file name "Supertext" something fancy
like "SuperText". It will not work and if it somehow does, it will have 
undesirable behaviours.


Add lines 14-17 to the bottom of your config.php file. You will find this file 
in the path like {root_dir}/application/config/config.php

Supported protocols are HTTP and HTTPS.

$config['supertext'] = array(
    'username' => 'YOUR_USERNAME_HERE',
    'password' => 'YOUR_PASSWORD_HERE'
);

Lastly, load the library for use by adding the line 16 to your controller.

$this->load->library('supertext', $this->config->item('supertext'));

Voila! You're all good to go. Happy coding!
