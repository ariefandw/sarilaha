<?php

namespace App\Models;

enum StatusUjian: int
{
    // case DIBATALKAN = -1;
    // case DRAFT      = 0;
    case BARU = 1;
    // case DISETUJUI  = 2;
    case REVISI = 2;
    case LULUS = 3;
}