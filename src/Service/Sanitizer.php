<?php


namespace App\Service;


class Sanitizer
{
    public $sanatizedItems;

    /**
     * Sanitizer constructor.
     * @param array $toSanatize
     */
    public function __construct(array $toSanatize)
    {
        foreach ($toSanatize as $sanatize) {
            $sanatized = htmlspecialchars($sanatize);
            $this->sanatizedItems[] = $sanatized;
        }
        return $this->sanatizedItems;
    }

}