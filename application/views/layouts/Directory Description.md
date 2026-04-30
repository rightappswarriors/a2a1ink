##
````
Page Layouts and Templates
````

This directory contains the structural templates that wrap page content to provide consistent navigation, headers, and footers:

- **authenticated.view.php** - Master layout for authenticated users with sidebar navigation
- **guest.view.php** - Minimal layout for guest/unauthenticated pages (login, register)

Layouts define the common HTML structure, meta tags, and layout containers that individual page views extend. They typically include header, footer, navigation, and content sections that child views can populate.
