<?php

/* Copyright (c) 2016 Richard Klees <richard.klees@concepts-and-training.de> Extended GPL, see docs/LICENSE */

namespace ILIAS\UI\Implementation\Component\Button;

use ILIAS\UI\Component as C;
use ILIAS\UI\Implementation\Component\Button\LoadingAnimationOnClick;

class Standard extends Button implements C\Button\Standard
{
    use LoadingAnimationOnClick;
    use Engageable;
}
