<?php

namespace App\Services;

class Version
{
    const MAJOR = 2;
    const MINOR = 5;
    const PATCH = 0;

    /**
     * Return the application version based on git.
     *
     * @return string
     */
    public static function get(): string
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s-%s [%s]', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
    }
}
