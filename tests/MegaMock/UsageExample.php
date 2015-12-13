<?php

$myMock = new MegaMock('SomeType');
$myMock->someFunction()->willReturn(456);

assert($myMock->getObject()->someFunction() == 456);
