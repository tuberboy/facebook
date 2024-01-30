<?php
require 'RSA.php';
require 'BigInteger.php';
require 'Hash.php';
require 'Random.php';

class PasswordEncryptor {
    private $pubkeyBytes;
    private $keyId;

    public function __construct($pubkeyBytes, $keyId) {
        $this->pubkeyBytes = $pubkeyBytes;
        $this->keyId = $keyId;
    }

    public function encryptPassword($password) {
        $randKey = random_bytes(32);
        $iv = random_bytes(12);

        $pubkey = openssl_pkey_get_public($this->pubkeyBytes);
        $encryptedRandKey = '';
        openssl_public_encrypt($randKey, $encryptedRandKey, $pubkey);

        $cipherAes = openssl_encrypt(
            $password,
            'aes-256-gcm',
            $randKey,
            OPENSSL_RAW_DATA,
            $iv,
            $authTag,
            time()
        );

        $buf = "\x01" . pack('n', $this->keyId) . $iv . pack('n', strlen($encryptedRandKey)) . $encryptedRandKey . $authTag . $cipherAes;
        $encoded = base64_encode($buf);

        return "#PWD_FB4A:2:" . time() . ":" . $encoded;
    }
}

$pubkeyBytes = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArbd8VjAw2abyJ4eFWRtK\nT7sI0UGmHRLtAtsp0tCI3yXxA5V4xEhLlc2SCXWpHxmjFuQ5vh37JyVQZLDxB5Vc\nLPa1S8Lqsk0WfMnSEi5r5dpxThIF77JpJ9J9/L7oh1IGCFpsYQyQCXxOuXQd8XX4\nYJV5aShUDtwLOMBgaqkGj5QHpNBGHMqewjwXUHMrh0FFFskEzQUkhzNEme7ogdvf\nyvRwXvvJFZvp00XXnkTUMhmKa1UmhL0haqlXrGd1WfOs2WnAp6iJtIkKSCZSpPib\njIdS4VUhrCzUkjr+mvbRPO2Isz8JT80BL2pD2ob6Z5W9s/qcfquNqxNlvCP6u5qx\nvwIDAQAB\n-----END PUBLIC KEY-----";
$keyId = 230;

$encryptor = new PasswordEncryptor($pubkeyBytes, $keyId);
$encryptedPassword = $encryptor->encryptPassword("mishu444");

echo $encryptedPassword;

/*
function encrypt($password, $publicKey, $keyId)
{
		$time = time();
		$session_key = random_bytes(32);
		$iv = random_bytes(12);
		$tag= '';
		$rsa = new RSA();
		
		$rsa->loadKey($publicKey); 
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
		$enc_session_key = $rsa->encrypt($session_key);
        $encrypted = openssl_encrypt( $password,'aes-256-gcm',$session_key,OPENSSL_RAW_DATA,$iv,$tag,intVal($time));
		
		return "#PWD_FB4A:2:".$time.":".base64_encode(("\x01" . pack('n', intval($keyId)) .$iv. pack('n',strlen($enc_session_key) ) . $enc_session_key . $tag . $encrypted));
}

$p = "mishu444";
$publicKey = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArbd8VjAw2abyJ4eFWRtK
T7sI0UGmHRLtAtsp0tCI3yXxA5V4xEhLlc2SCXWpHxmjFuQ5vh37JyVQZLDxB5Vc
LPa1S8Lqsk0WfMnSEi5r5dpxThIF77JpJ9J9/L7oh1IGCFpsYQyQCXxOuXQd8XX4
YJV5aShUDtwLOMBgaqkGj5QHpNBGHMqewjwXUHMrh0FFFskEzQUkhzNEme7ogdvf
yvRwXvvJFZvp00XXnkTUMhmKa1UmhL0haqlXrGd1WfOs2WnAp6iJtIkKSCZSpPib
jIdS4VUhrCzUkjr+mvbRPO2Isz8JT80BL2pD2ob6Z5W9s/qcfquNqxNlvCP6u5qx
vwIDAQAB
-----END PUBLIC KEY-----";

$keyId     = 230;

//$enc_pass = urlencode(encrypt($p, $publicKey, $keyId));
$enc_pass = encrypt($p, $publicKey, $keyId);

echo $enc_pass;
*/
?>