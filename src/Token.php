<?php

namespace Gravatalonga\Lexer;

class Token
{
    const TKN_END = 0;

    const TKN_COMMA = 1;

    const TKN_WS = 2;

    const TKN_OPEN_PARENTESES = 3;

    const TKN_CLOSE_PARENTESES = 4;

    const TKN_OPEN_BRACKET = 5;

    const TKN_CLOSE_BRACKET = 6;

    const TKN_OPEN_CURLY_BRACES = 7;

    const TKN_CLOSE_CURLY_BRACES = 8;

    const TKN_DBL_QUOTE = 8;

    const TKN_PLUS = 9;

    const TKN_MINUS = 10;

    const TKN_DIVIDER = 11;

    const TKN_ASTERIC = 12;

    const TKN_EQUAL = 13;

    const TKN_CRLF = 14;

    const LITERAL = 15;

    const NUMBER = 16;

    public $tokens = [
        ';' => self::TKN_END,
        ',' => self::TKN_COMMA,
        ' ' => self::TKN_WS,
        '(' => self::TKN_OPEN_PARENTESES,
        ')' => self::TKN_CLOSE_PARENTESES,
        '[' => self::TKN_OPEN_BRACKET,
        ']' => self::TKN_CLOSE_BRACKET,
        '{' => self::TKN_OPEN_CURLY_BRACES,
        '}' => self::TKN_CLOSE_CURLY_BRACES,
        '"' => self::TKN_DBL_QUOTE,
        '+' => self::TKN_PLUS,
        '-' => self::TKN_MINUS,
        '/' => self::TKN_DIVIDER,
        '*' => self::TKN_ASTERIC,
        '=' => self::TKN_EQUAL,
        "\n\r" => self::TKN_CRLF,
        "\n" => self::TKN_CRLF,
        "\r" => self::TKN_CRLF
    ];

    /**
     * @var string
     */
    private $untrustedCode;

    /**
     * @var array
     */
    private array $consumedTokens;

    public function __construct($untrustedCode)
    {
        $this->untrustedCode = $untrustedCode;
        $this->parser = null;
    }

    public function consume()
    {
        $cursor = 0;
        $length = strlen($this->untrustedCode);

        $tokens = [];
        while($cursor < $length) {
            foreach ($this->tokens as $token => $const) {
                $analyze = $this->untrustedCode[$cursor];
                if ($analyze === $token) {
                    $tokens[$cursor] = $const;
                }

                if (preg_match('/[a-z]/', $analyze)) {
                    $tokens[$cursor] = self::LITERAL;
                }

                if (preg_match('/[A-Z]/', $analyze)) {
                    $tokens[$cursor] = self::LITERAL;
                }

                if (preg_match('/[0-9]/', $analyze)) {
                    $tokens[$cursor] = self::NUMBER;
                }

            }
            $cursor++;
        }

        $this->consumedTokens = $tokens;
    }

    public function peek()
    {
        $array = array_reverse($this->consumedTokens);
        return array_pop($array);
    }
}