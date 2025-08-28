<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function encrypt_url($string) {

    $output = false;

    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */
    $security = parse_ini_file('security.ini');
    $secret_key = $security['encryption_key'];
    $secret_iv = $security['iv'];
    $encrypt_method = $security['encryption_mechanism'];


    // hash
    $key = hash('sha256', $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);

    return $output;
}


function decrypt_url($string) {

    $output = false;
    
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security = parse_ini_file('security.ini');
    $secret_key = $security['encryption_key'];
    $secret_iv = $security['iv'];
    $encrypt_method = $security['encryption_mechanism'];

    // hash
    $key = hash('sha256', $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the decryption given text/string/number
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}

//Test
// function ci_encrypt_url($param){
//     $ci = & get_instance();
//     $ci->load->library('encrypt');    
//     $key = $ci->config->item('encryption_key');
//     $encrypt = base64_encode(hash('sha256', $key));

//     return $ci->encrypt->encode($param, $encrypt);
// }

// function ci_decrypt_url($param){
//     $ci = & get_instance();
//     $ci->load->library('encrypt');    
//     $key = $ci->config->item('encryption_key');
//     $encrypt = base64_decode(hash('sha256', $key));
//     return $ci->encrypt->decode($param, $encrypt);
// }