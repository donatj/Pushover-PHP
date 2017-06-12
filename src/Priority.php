<?php

namespace donatj\Pushover;

interface Priority {
	const LOWEST    = -2;
	const LOW       = -1;
	const NORMAL    = 0;
	const HIGH      = 1;
	const EMERGENCY = 2;
}
