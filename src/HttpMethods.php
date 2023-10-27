<?php

interface HttpMethods
{
function getRoute();
function postRoute($endpoint);
function deleteRoute();
function putRoute();
}