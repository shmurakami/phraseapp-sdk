<?php

// how to do?

use shmurakami\PhraseAppSDK\Objects\Project;
use shmurakami\PhraseAppSDK\PhraseAppApi;

$accessToken = 'token';

$api = new PhraseAppApi($accessToken);

$projectId = 'abcd';

$proj = new Project($projectId, $api);
$proj->keys();

$key = new Key($projectId, $api);

