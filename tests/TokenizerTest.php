<?php

namespace Tests;

use Gravatalonga\Lexer\Token;
use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{
    /** @test */
    public function test_can_tokenizer_string()
    {
        $code = "";
        $tokens = new Token($code);

        $this->assertInstanceOf(Token::class, $tokens);
    }

    /**
     * @test
     * @dataProvider dataProviderCanProcessTokens
     */
    public function can_process_tokens($code, $token)
    {
        $tokens = new Token($code);

        $tokens->consume();

        $this->assertEquals($token, $tokens->peek());
    }

    /**
     * @test
     * @dataProvider dataProviderCanParseVariableLiteralsAndNumber
     */
    public function can_parse_literals_and_numbers($code, $token)
    {
        $tokens = new Token($code);

        $tokens->consume();

        $this->assertEquals($token, $tokens->peek());
    }

    public function dataProviderCanProcessTokens()
    {
        return [
            [';', Token::TKN_END],
            [',', Token::TKN_COMMA],
            [' ', Token::TKN_WS],
            ['(', Token::TKN_OPEN_PARENTESES],
            [')', Token::TKN_CLOSE_PARENTESES],
            ['[', Token::TKN_OPEN_BRACKET],
            [']', Token::TKN_CLOSE_BRACKET],
            ['{', Token::TKN_OPEN_CURLY_BRACES],
            ['}', Token::TKN_CLOSE_CURLY_BRACES],
            ['"', Token::TKN_DBL_QUOTE],
            ['+', Token::TKN_PLUS],
            ['-', Token::TKN_MINUS],
            ['/', Token::TKN_DIVIDER],
            ['*', Token::TKN_ASTERIC],
            ['=', Token::TKN_EQUAL],
            ["\n\r", Token::TKN_CRLF],
            ["\n", Token::TKN_CRLF],
            ["\r", Token::TKN_CRLF]
        ];
    }

    public function dataProviderCanParseVariableLiteralsAndNumber()
    {
        return [
            ['abc', Token::LITERAL],
            ['ABC', Token::LITERAL],
            ['123', Token::NUMBER],
            ['123.30', Token::NUMBER]
        ];
    }
}