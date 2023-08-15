<?php

namespace donatj\Pushover;

/**
 * Contains all legal values for 'priority'
 */
interface Priority {

	public const LOWEST    = -2;
	public const LOW       = -1;
	public const NORMAL    = 0;
	public const HIGH      = 1;
	public const EMERGENCY = 2;

}
