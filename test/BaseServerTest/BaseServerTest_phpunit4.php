<?php

use donatj\MockWebServer\MockWebServer;
use PHPUnit\Framework\TestCase;

abstract class BaseServerTest extends TestCase {

	/** @var MockWebServer */
	protected static $server;

	public static function setUpBeforeClass() {
		self::$server = new MockWebServer;
		self::$server->start();
	}

	public static function tearDownAfterClass() {
		self::$server->stop();
	}

	public function expectException() : void {
		// noop
	}

	public function expectExceptionCode() : void {
		// noop
	}

	public function expectExceptionMessageMatches() : void {
		// noop
	}

}
