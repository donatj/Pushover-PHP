<?php

use donatj\MockWebServer\MockWebServer;
use donatj\Pushover\Options;
use donatj\Pushover\Pushover;
use donatj\Pushover\Sounds;

class PushoverTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var MockWebServer
	 */
	protected static $server;

	public static function setUpBeforeClass() {
		self::$server = new MockWebServer;
		self::$server->start();
	}

	public function test_BasicMessage() {
		$url = self::$server->getUrlOfResponse(json_encode([ 'a' => 'b' ]));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertSame([ 'a' => 'b' ], $response);

		$request = self::$server->getLastRequest();
		$this->assertSame('POST', $request['METHOD']);
		$this->assertSame('application/x-www-form-urlencoded', $request['HEADERS']['Content-Type']);
		$this->assertSame([
			'token'   => 'token',
			'user'    => 'user',
			'message' => 'Hello World!',
		], $request['PARSED_INPUT']);
	}

	public function test_ComplexMessage() {
		$url = self::$server->getUrlOfResponse(json_encode([ 'a' => 'b' ]));
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
		$this->assertSame('POST', $request['METHOD']);
		$this->assertSame('application/x-www-form-urlencoded', $request['HEADERS']['Content-Type']);
		$this->assertSame([
			'device'   => 'totem',
			'priority' => '1',
			'message'  => 'Hello World!',
			'token'    => 'token',
			'user'     => 'user',
			'sound'    => 'magic',
			'url'      => 'https://donatstudios.com',
		], $request['PARSED_INPUT']);
	}

	public function test_Failure_non200() {
		$url = self::$server->getUrlOfResponse(json_encode([ 'a' => 'b' ]), [], 500);
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertSame(false, $response);
	}

	public function test_Failure_invalidResponse() {
		$url = self::$server->getUrlOfResponse('this is not JSON like at all');
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertSame(false, $response);
	}


	public static function tearDownAfterClass() {
		self::$server->stop();
	}

}
