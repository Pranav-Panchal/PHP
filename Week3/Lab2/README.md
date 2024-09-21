# Book Management System

This is a simple **Book Management System** built using PHP and AJAX. The system allows users to add book details such as the title, author, and publication year. Data is validated and sent to the server via AJAX, ensuring the page does not reload when adding a new book. The book list is dynamically updated on the page without a refresh.

## Features

- Add a book with the following details:
  - Title 
  - Author 
  - Publication year (valid year between 1000 and the current year)
- Dynamically display the book list without page reload using AJAX.
- Validation for:
  - Title (must contain only letters and spaces, no numbers)
  - Author (must contain only letters and spaces, no numbers)
  - Year (must be a number between 1000 and the current year)
- Error messages are shown next to the respective fields if validation fails.

## Technologies Used

- **PHP**: For server-side logic and book validation.
- **AJAX**: To send form data to the server without reloading the page.
- **HTML/CSS**: For the form and book list UI.
- **JavaScript**: For AJAX handling and dynamic updates of the book list.


