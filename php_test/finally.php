<?php

echo "It returns:".myFunction();

function myFunction()
{
    try{
        return "try block";
    } catch (Exception $ex) {

    } finally {
        return "finally block";
    }
}