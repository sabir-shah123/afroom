<?php

function checkLogin()
{
    if (!isset($_SESSION['unqid']) || !isset($_SESSION['logintype']) || !in_array($_SESSION['logintype'], ['Customer', 'Provider'])) {
        session_abort();
        return false;
    }
    return true;

}
