<?php

namespace Helpers;

class HTMLSpecial
{
    public function h($content) {
        return htmlspecialchars($content);
    }
}