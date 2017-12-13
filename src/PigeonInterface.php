<?php

namespace RoundPartner\Pigeon;

interface PigeonInterface
{
    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $text
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendEmail($from, $to, $subject, $text);
}