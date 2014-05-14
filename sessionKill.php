<?php
    session_name('greenOffice');
    session_start();
    session_destroy();
    require 'index.php';

    