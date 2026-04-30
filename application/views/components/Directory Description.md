##
````
Reusable UI Components
````

This directory contains modular, reusable UI components that can be embedded across multiple views:

- **authenticated/** - Components for authenticated user contexts
  - **header.view.php** - Top navigation header with user menu
  - **footer.view.php** - Application footer
- **guest/** - Components for guest/unauthenticated contexts
  - **header.view.php** - Simplified header for public pages
  - **footer.view.php** - Minimal footer for public pages

Components are self-contained view fragments that encapsulate specific UI elements, promoting consistency and reducing duplication across the application.
