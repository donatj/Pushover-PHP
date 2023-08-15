<?php

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response;
use donatj\Pushover\Exceptions\ResponseException;
use donatj\Pushover\Options;
use donatj\Pushover\Pushover;
use donatj\Pushover\Sounds;
use PHPUnit\Framework\TestCase;

class PushoverTest extends TestCase {

	/** @var MockWebServer */
	private static $server;

	public static function setUpBeforeClass() : void {
		self::$server = new MockWebServer;
		self::$server->start();
	}

	public static function tearDownAfterClass() : void {
		self::$server->stop();
	}

	public function test_BasicMessage() : void {
		$url = self::$server->getUrlOfResponse(new Response(json_encode([ 'a' => 'b' ])));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertSame([ 'a' => 'b' ], $response);

		$request = self::$server->getLastRequest();
		$this->assertSame('POST', $request->getRequestMethod());
		$this->assertSame('application/x-www-form-urlencoded', $request->getHeaders()['Content-Type']);
		$this->assertSame([
			'token'   => 'token',
			'user'    => 'user',
			'message' => 'Hello World!',
		], $request->getParsedInput());
	}

	public function test_ComplexMessage() : void {
		$url = self::$server->getUrlOfResponse(new Response(json_encode([ 'a' => 'b' ])));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!', [
			Options::DEVICE   => 'totem',
			Options::PRIORITY => \donatj\Pushover\Priority::HIGH,
			Options::MESSAGE  => 'Not the initially set message',
			Options::TOKEN    => 'Different Token… For some reason…',
			Options::USER     => 'And a different user just for kicks',
			Options::SOUND    => Sounds::MAGIC,
			Options::URL      => 'https://donatstudios.com',
		]);
		$this->assertSame([ 'a' => 'b' ], $response);

		$request = self::$server->getLastRequest();
		$this->assertSame('POST', $request->getRequestMethod());
		$this->assertSame('application/x-www-form-urlencoded', $request->getHeaders()['Content-Type']);
		$this->assertSame([
			'device'   => 'totem',
			'priority' => '1',
			'message'  => 'Hello World!',
			'token'    => 'token',
			'user'     => 'user',
			'sound'    => 'magic',
			'url'      => 'https://donatstudios.com',
		], $request->getParsedInput());
	}

	public function test_Failure_non200() : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Failed to connect/');
		$this->expectExceptionCode(ResponseException::ERROR_CONNECTION_FAILED);
		$url = self::$server->getUrlOfResponse(new Response(json_encode([ 'a' => 'b' ]), [], 500));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	public function test_Failure_badUrl() : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Failed to connect/');
		$this->expectExceptionCode(ResponseException::ERROR_CONNECTION_FAILED);

		$p = new Pushover('token', 'user', 'this is not a url');

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	public function test_Failure_invalidResponse() : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Failed to decode/');
		$this->expectExceptionCode(ResponseException::ERROR_DECODE_FAILED);
		$url = self::$server->getUrlOfResponse(new Response('this is not JSON like at all'));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	/**
	 * @dataProvider provideUnexpectedJSON
	 */
	public function test_Failure_unexpectedResponse(string $json) : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Unexpected response/');
		$this->expectExceptionCode(ResponseException::ERROR_UNEXPECTED);
		$url = self::$server->getUrlOfResponse(new Response($json));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	public function provideUnexpectedJSON() : \Generator {
		yield [ 'null' ];
		yield [ 'true' ];
		yield [ 'false' ];
		yield [ '0' ];
		yield [ '1' ];
		yield [ '""' ];
	}

}
