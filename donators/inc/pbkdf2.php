<?php
/* These constants may be changed without breaking existing hashes.
 *
 * Supported algorithms are: md2, md4, md5, sha1, sha224, sha256, sha384, 
 * sha512, ripemd128, ripemd160,  ripemd256,  ripemd320,  whirlpool,  tiger128,3,
 * tiger160,3,  tiger192,3,  tiger128,4,  tiger160,4,  tiger192,4,  snefru,
 * snefru256, gost,  adler32,  crc32,  crc32b,  salsa10,  salsa20,  haval128,3,
 * haval160,3,  haval192,3,  haval224,3,  haval256,3,  haval128,4,  haval160,4, 
 * haval192,4,  haval224,4, haval256,4,  haval128,5,  haval160,5,  haval192,5, 
 * haval224,5,  haval256,5, 
 *
 */

define("PBKDF2_HASH_ALGORITHM", "sha512");
define("PBKDF2_ITERATIONS", 100);
define("PBKDF2_SALT_BYTES", 15);
define("PBKDF2_HASH_BYTES", 32);
define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);
define("HASH_SALT",bin2hex(mcrypt_create_iv(PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM)));

function create_hash($password)
{
    if (function_exists("hash_pbkdf2"))
      return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  HASH_SALT . ":" . bin2hex(hash_pbkdf2(PBKDF2_HASH_ALGORITHM, $password, HASH_SALT, PBKDF2_ITERATIONS, PBKDF2_HASH_BYTES, true));
    else
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  HASH_SALT . ":" . bin2hex(pbkdf2(PBKDF2_HASH_ALGORITHM, $password, HASH_SALT, PBKDF2_ITERATIONS, PBKDF2_HASH_BYTES, true));
}

function validate_password($password, $good_hash)
{
    $params = explode(":", $good_hash);
    if(count($params) < HASH_SECTIONS)
       return "Invlid section count"; 
    $pbkdf2 = hex2bin($params[HASH_PBKDF2_INDEX]);
    if (function_exists("hash_pbkdf2")) 
        return slow_equals($pbkdf2,hash_pbkdf2($params[HASH_ALGORITHM_INDEX], $password, $params[HASH_SALT_INDEX], (int)$params[HASH_ITERATION_INDEX], strlen($pbkdf2), true));
    else
        return slow_equals($pbkdf2,pbkdf2($params[HASH_ALGORITHM_INDEX], $password, $params[HASH_SALT_INDEX], (int)$params[HASH_ITERATION_INDEX], strlen($pbkdf2), true));
}

function slow_equals($a, $b) // Compares two strings $a and $b in length-constant time.
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0; 
}

/*
 * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
 * $algorithm - The hash algorithm to use. Recommended: SHA256
 * $password - The password.
 * $salt - A salt that is unique to the password.
 * $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
 * $key_length - The length of the derived key in bytes.
 * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
 * Returns: A $key_length-byte key derived from the password and salt.
 *
 * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
 *
 * This implementation of PBKDF2 was originally created by https://defuse.ca
 * With improvements by http://www.variations-of-shadow.com
 *
 * This fucntion as been added to PHP 5.5.1 as hash_pbkdf2()
 * See PHP docs here: http://www.php.net/manual/en/function.hash-pbkdf2.php
 */

function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        die('PBKDF2 ERROR: Invalid hash algorithm.');

    if($count <= 0 || $key_length <= 0)
        die('PBKDF2 ERROR: Invalid parameters.');

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);
    $output = "";

    for($i = 1; $i <= $block_count; $i++) { 
        $last = $salt . pack("N", $i);    // $i encoded as 4 bytes, big endian.
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true); // first iteration

        for ($j = 1; $j < $count; $j++) {// perform the other $count - 1 iterations
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output)
        return substr($output, 0, $key_length);
    else
        return bin2hex(substr($output, 0, $key_length));
}
