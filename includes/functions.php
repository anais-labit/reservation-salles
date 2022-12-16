<?php

// traduire jours
function translateDay($day)
{
    $days = [
        "Monday" => "Lundi ",
        "Tuesday" => "Mardi ",
        "Wednesday" => "Mercredi ",
        "Thursday" => "Jeudi ",
        "Friday" => "Vendredi ",
    ];
    return $days[$day];
}

// traduire mois
function translateMonth($month)
{
    $months = [
        "Junuary" => " Janvier",
        "February" => " Février",
        "March" => " Mars",
        "April" => " Avril",
        "May" => " Mai",
        "June" => " Juin",
        "July" => " Juillet",
        "Agust" => " Août",
        "September" => " Septembre",
        "October" => " Octobre",
        "November" => " Novembre",
        "December" => " Décembre",
    ];
    return $months[$month];
}
