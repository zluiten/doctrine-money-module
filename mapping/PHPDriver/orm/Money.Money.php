<?php

$metadata->isEmbeddedClass = true;

$metadata->mapField(array(
    'fieldName' => 'amount',
    'type' => 'integer',
    'nullable' => false
));

$metadata->mapField(array(
    'fieldName' => 'currency',
    'type' => 'currency',
    'nullable' => false
));
