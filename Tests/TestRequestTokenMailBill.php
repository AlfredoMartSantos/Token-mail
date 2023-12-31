<?php namespace Pelrock\SignatureMailToken\Tests;
use Pelrock\SignatureMailToken\Guards\CheckJson;
use Pelrock\SignatureMailToken\Guards\CheckKey;
use Pelrock\SignatureMailToken\Token;
use Pelrock\SignatureMailToken\RequestTokenMailBill;
use PHPUnit\Framework\TestCase;

class TestRequestTokenMailBill extends TestCase
{
    private $token;
    private $request;
    private $cypher='AES-256-CBC';
    private $key ='DoruscomByPelrock2024ExampleKey';
    private $vector = 'BRGI_dev';

    public function setUp()
    {
        $this->token = new Token($this->key, $this->vector, $this->cypher);
        $this->request = new RequestTokenMailBill([new CheckKey(), new CheckJson()]);
    }
    /** @test */
    public function should_sign_request() {
        $string = "{\"userId\":\"859205\",\"username\":\"admin\"}";
        $auth = $this->request->sign($this->token, $string);
        $this->assertEquals("QW9GTGwrS29ZTnN5S0d3aVU0NUE2azhmYmc2bjhHMElWbWsyODJNYys1REFJWEtST2wyQllBN1JFNlhsVFY0Mg==", $auth);
    }
    /** @test  */
    public function should_unsing_request()
    {
        $auth = $this->request->unSign($this->token, "QW9GTGwrS29ZTnN5S0d3aVU0NUE2azhmYmc2bjhHMElWbWsyODJNYys1REFJWEtST2wyQllBN1JFNlhsVFY0Mg==");
        $string = "{\"userId\":\"859205\",\"username\":\"admin\"}";
        $this->assertEquals($string, $auth);
    }
    /** @test */
    public function should_throw_exception_on_missing_key()
    {
        $this->setExpectedException('Pelrock\SignatureMailToken\Exceptions\SignatureKeyException');
        $this->token = new Token(null, $this->vector, $this->cypher);
        $string = "{\"userId\":\"859205\",\"username\":\"admin\"}";
        $auth = $this->request->sign($this->token, $string);
    }
    /** @test  */
    public function sould_throw_exception_json_to_decode_wrong()
    {
        $this->setExpectedException('Pelrock\SignatureMailToken\Exceptions\SignatureJsonDecodeException');
        $auth = $this->request->unSign($this->token, "ascodetoken");

    }
    /** @test */
    public function should_throw_exception_json_to_encode_wrong()
    {
        $this->setExpectedException('Pelrock\SignatureMailToken\Exceptions\SignatureJsonDecodeException');
        $string = "{}{\"userId\":\"859205\",\"username\":\"admin\"}";
        $auth = $this->request->sign($this->token, $string);

    }
}

