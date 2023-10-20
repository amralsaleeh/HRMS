<?php

// Custom Config
// -------------------------------------------------------------------------------------
//! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
//! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).

return [
  'custom' => [
    'myLayout' => 'vertical', // Options[String]: vertical(default), horizontal
    'myTheme' => 'theme-default', // Options[String]: theme-default(default), theme-bordered, theme-semi-dark
    'myStyle' => 'light', // Options[String]: light(default), dark
    'myRTLSupport' => true, // options[Boolean]: true(default), false // To provide RTLSupport or not
    'myRTLMode' => false, // options[Boolean]: false(default), true // To set layout to RTL layout  (myRTLSupport must be true for rtl mode)
    'hasCustomizer' => true, // options[Boolean]: true(default), false // Display customizer or not THIS WILL REMOVE INCLUDED JS FILE. SO LOCAL STORAGE WON'T WORK
    'displayCustomizer' => true, // options[Boolean]: true(default), false // Display customizer UI or not, THIS WON'T REMOVE INCLUDED JS FILE. SO LOCAL STORAGE WILL WORK
    'menuFixed' => true, // options[Boolean]: true(default), false // Layout(menu) Fixed
    'menuCollapsed' => false, // options[Boolean]: false(default), true // Show menu collapsed, Only for vertical Layout
    'navbarFixed' => false, // options[Boolean]: false(default), true // Navbar Fixed
    'footerFixed' => false, // options[Boolean]: false(default), true // Footer Fixed
    'showDropdownOnHover' => true, // true, false (for horizontal layout only)
    'customizerControls' => [
      'rtl',
      'style',
      'layoutType',
      'showDropdownOnHover',
      'layoutNavbarFixed',
      'layoutFooterFixed',
      'themes',
    ], // To show/hide customizer options
  ],
];
