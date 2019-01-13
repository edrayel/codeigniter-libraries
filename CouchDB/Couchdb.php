<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Overview
|--------------------------------------------------------------------------
|
| This is a simple library that allows the CodeIgniter framewoek to 
| communicate with Apache's CouchDB Database. The library does this
| using HTTP requests. 
|
*/

class Couchdb {

    protected $CI;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->CI =& get_instance();
    }

    /**
     * DDL operations
     */
    public function create_db(string $db_name): string 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $this->config['port'],
            CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => $this->config['authorization']
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #: " . $err;
        } else {
            return $response;
        }
    }

    public function delete_db(string $db_name): string 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $this->config['port'],
            CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => $this->config['authorization']
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #: " . $err;
        } else {
            return $response;
        }
    }
    
    /**
     * DML operations
     */
    public function get_doc(string $id): string 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $this->config['port'],
        CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'] . "/" . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => $this->config['authorization']
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function create_doc(array $fields): string 
    {
        $curl = curl_init();
        $curl_http_header = array($this->config['authorization'][0], "content-type: application/json");

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $this->config['port'],
        CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => $curl_http_header
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function update_doc(string $id, array $fields, string $rev_id): string 
    {
        $fields['_rev'] = $rev_id;
        $curl = curl_init();
        $curl_http_header = array($this->config['authorization'][0], "content-type: application/json");

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $this->config['port'],
        CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'] . "/" . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => $curl_http_header
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function delete_doc(string $id, string $rev_id): string 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $this->config['port'],
        CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'] . "/" . $id . "?rev=" . $rev_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => $this->config['authorization']
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function get_view(string $view_name, string $index, string $id_or_key): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $this->config['port'],
        CURLOPT_URL => $this->config['protocol'] . "://" . $this->config['domain'] . ":" . $this->config['port'] . "/" . $this->config['db_name'] . "/" . "_design" . "/" . $view_name . "/" . "_view" . "/" . $index . "?key=" . "%22$id_or_key%22",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => $this->config['authorization']
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
