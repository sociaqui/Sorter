<?php

namespace app\Parser\Reader;

/**
 * Interface ReaderInterface
 */
interface ReaderInterface
{

    /**
     * Read a string and create an array
     *
     * @param string $string
     *
     * @return array
     */
    public function fromString($string);

    /**
     * Read a file and create an array
     *
     * @param $filename
     *
     * @return array or bool
     */
    public function fromFile($filename);

}
