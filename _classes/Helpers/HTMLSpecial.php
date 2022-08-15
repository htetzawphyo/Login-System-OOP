<?php

namespace Helpers;

class HTMLSpecialChars
{
    public function h($content) {
        return htmlspecialchars($content);
    }
}