<?php

function isOnline(): bool
{
    if (isset($_SESSION['membres'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin(): bool
{
    if (isOnline() && $_SESSION['membres']['statut'] == "administrateur") {
        return true;
    } else {
        return false;
    }
}

function treatmentText(string $value): string
{
    htmlspecialchars($value);
    return $value;
}

function getCurrentDate(): string
{
    $dateActuelle = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $dateFormatee = $dateActuelle->format('Y-m-d');
    return $dateFormatee;
}

function getTitle(string $url): string
{

    $separeWords = explode(".", $url);
    $getTitle = ucfirst($separeWords[0]);

    return $getTitle;
}

function getSubTitle(string $url): string
{
    $separeWords = explode(".", $url);
    $getSubTitle = str_replace("_", " ", $separeWords[1]);

    return ucfirst($getSubTitle);
}
