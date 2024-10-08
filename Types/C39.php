<?php

declare(strict_types=1);

namespace Barcode\Types;

use Barcode\BarcodeGenerator;

/**
 * Code 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9
 */
class C39 extends BarcodeGenerator
{
    protected static array $CONVERSION_TABLE = [
        '0' => '111221211', '1' => '211211112', '2' => '112211112', '3' => '212211111', '4' => '111221112',
        '5' => '211221111', '6' => '112221111', '7' => '111211212', '8' => '211211211', '9' => '112211211',
        'A' => '211112112', 'B' => '112112112', 'C' => '212112111', 'D' => '111122112', 'E' => '211122111',
        'F' => '112122111', 'G' => '111112212', 'H' => '211112211', 'I' => '112112211', 'J' => '111122211',
        'K' => '211111122', 'L' => '112111122', 'M' => '212111121', 'N' => '111121122', 'O' => '211121121',
        'P' => '112121121', 'Q' => '111111222', 'R' => '211111221', 'S' => '112111221', 'T' => '111121221',
        'U' => '221111112', 'V' => '122111112', 'W' => '222111111', 'X' => '121121112', 'Y' => '221121111',
        'Z' => '122121111', '-' => '121111212', '.' => '221111211', ' ' => '122111211', '$' => '121212111',
        '/' => '121211121', '+' => '121112121', '%' => '111212121', '*' => '121121211',
    ];

    protected static string $CODE_START = '1211212111';
    protected static string $CODE_END   = '121121211';

    /**
     * Şifrelenecek içeriği ayarlar.
     * Set content to encrypt.
     */
    public function setContent(string $content): void
    {
        parent::setContent(\strtoupper($content));
    }

    /**
     * C39 standartında kod dizesi oluşturur.
     * Generates code string in C39 standard.
     */
    protected function generateCodeString(): string
    {
        $code   = '';
        $length = \strlen($this->content);

        for ($X = 1; $X <= $length; ++$X) {
            $code .= self::$CONVERSION_TABLE[\substr($this->content, ($X - 1), 1)] . '1';
        }

        return $code;
    }
}
