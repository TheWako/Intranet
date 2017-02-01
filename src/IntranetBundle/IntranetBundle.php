<?php

namespace IntranetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IntranetBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
