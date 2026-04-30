##
````
View Includes and Assets
````

This directory contains reusable view partials and asset configurations that are included across multiple pages:

- **assets-authenticated.view.php** - CSS/JS asset bundles for authenticated (logged-in) users
- **assets-guest.view.php** - CSS/JS asset bundles for guest (non-authenticated) users

These files define the scripts and stylesheets loaded for different user contexts, ensuring proper dependency management and page-specific asset loading.
