<?php


namespace App\Service;


class Sanitizer
{
    private $sanatizedString;
    private $sanitizedArray;

    /**
     * @param string $toSanitize
     * @return string
     *
     */
    public function sanitizeString($toSanitize)
    {
        $this->sanatizedString = htmlspecialchars($toSanitize);
        return $this->sanatizedString;
    }

    public function sanitizeArray($toSanitize)
    {
        foreach ($toSanitize as $data) {
            $this->sanitizedArray[] = htmlspecialchars($toSanitize);
            return $this->sanitizedArray;
        }
    }

}