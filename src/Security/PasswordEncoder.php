<?php

namespace App\Security;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class PasswordEncoder implements PasswordEncoderInterface
{
    /**
     * @param string $raw
     * @param string|null $salt
     * @return string
     */
    public function encodePassword(string $raw, ?string $salt)
    {
        return md5($raw . $salt);
    }

    /**
     * @param string $encoded
     * @param string $raw
     * @param string|null $salt
     * @return bool
     */
    public function isPasswordValid(string $encoded, string $raw, ?string $salt)
    {
        return $raw === $encoded;
    }

    /**
     * @param string $encoded
     * @return bool
     */
    public function needsRehash(string $encoded): bool
    {
        return false;
    }

}