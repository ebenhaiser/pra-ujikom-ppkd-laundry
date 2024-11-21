<?php
function changeStatus($status = null){
    switch ($status){
        case 1:
            $badge = "<span class='badge bg-success'>Done</span>";
            break;
        case 0:
            $badge = "<span class='badge bg-warning'>New</span>";
            break;
    }

    return $badge;
}