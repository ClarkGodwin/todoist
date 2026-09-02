<?php

namespace App\Enums;

enum TaskStatus : string
{
    case ToDo = 'to_do';
    case BeingDone = 'being_done';
    case Done = 'done';
}
