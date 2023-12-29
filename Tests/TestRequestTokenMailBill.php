<?php namespace Pelrock\Signature\Tests;
use Pelrock\Signature\Token;
use Pelrock\Signature\RequestTokenMailBill;
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
        $this->request = new RequestTokenMailBill();
    }
    /** @test */
    public function should_sign_request()
    {
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

}

