<?php

use donatj\MockWebServer\Response;
use donatj\Pushover\Exceptions\ResponseException;
use donatj\Pushover\Options;
use donatj\Pushover\Pushover;
use donatj\Pushover\Sounds;

if( class_exists('\PHPUnit\Runner\Version') ) {
	require __DIR__ . '/BaseServerTest/BaseServerTest_phpunit9.php';
} else {
	require __DIR__ . '/BaseServerTest/BaseServerTest_phpunit4.php';
}

class PushoverTest extends BaseServerTest {

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
		$url = self::$server->getUrlOfResponse(new Response(json_encode([ 'a' => 'b' ]), [], 500));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	public function test_Failure_badUrl() : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Failed to connect/');

		$p = new Pushover('token', 'user', 'this is not a url');

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

	public function test_Failure_invalidResponse() : void {
		$this->expectException(ResponseException::class);
		$this->expectExceptionMessageMatches('/^Failed to decode/');
		$url = self::$server->getUrlOfResponse(new Response('this is not JSON like at all'));
		$p   = new Pushover('token', 'user', $url);

		$response = $p->send('Hello World!');
		$this->assertFalse($response);
	}

}
