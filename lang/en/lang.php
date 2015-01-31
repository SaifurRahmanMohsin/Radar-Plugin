<?php

return [
  'plugin' => [
    'name' => 'Radar',
    'description' => 'Determines closest branch to a customer.',
    'settingsinfo' => 'Manage the addresses of organization\'s branches.'
  ],
  'settings' => [
    'label' => 'Radar Settings',
    'description' => 'Set the distance matrix API Key for Radar.',
  ],
  'destinations' => [
    'heading' => 'Branch List',
    'description' => 'List of addresses to the various branches of your organization'
  ],
  'exception' => [
    'failed' => 'Failed to calculate shortest distance',
  ],
  'address' => [
    'name' => 'Place Name',
    'addr' => 'Place Address',
    'formattedaddr' => 'Formatted Address',
    'lat' => 'Latitude',
    'lng' => 'Longitude',
    'editor_title' => 'Edit Address',
    'add_address' => 'Add <u>A</u>ddress',
    'delete_confirm' => 'Are you sure you want to delete this address?',
    'delete_success' => 'Successfully deleted those addresses.'
  ],
  'locator' => [
    'name' => 'Locator Component',
    'description' => 'An input for user to enter their address and get the route map to the nearest branch.',
    'directions' => 'Get directions',
  ],
];
