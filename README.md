# API Contacts

This project is a study on building a RESTful API for managing contacts using PHP with Object-Oriented Programming (OOP). It provides endpoints to create, retrieve, update, and delete contact information.

## Features

- **Create Contact**: Add a new contact with details such as name, email, and phone number.
- **Retrieve Contacts**: Fetch a list of all contacts or a specific contact by ID.
- **Update Contact**: Modify the details of an existing contact.
- **Delete Contact**: Remove a contact from the database.

## Technologies Used

- **Programming Language**: PHP
- **Paradigm**: Object-Oriented Programming (OOP)
- **Database**: [Specify the database, e.g., MySQL, PostgreSQL]
- **API Documentation**: [Specify the tool, e.g., Postman, Swagger]

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/allangnutzmans/api-contacts.git
   cd api-contacts
   
Set up the database:

Import the provided database schema into your database.
Update the database configuration in the project (e.g., config/database.php).

Start a local server:

You can use PHP's built-in server for development:

php -S localhost:8000 -t public

Usage

After starting the application, you can use tools like Postman or curl to interact with the API. The available endpoints are:

GET /contacts: Retrieve all contacts.
GET /contacts/{id}: Retrieve a contact by ID.
POST /contacts: Create a new contact.
PUT /contacts/{id}: Update an existing contact.
DELETE /contacts/{id}: Delete a contact.

Contributing

Contributions are welcome! Please fork this repository and submit a pull request with your changes. Ensure that your code follows the project's coding standards and includes appropriate tests.

License

This project is licensed under the MIT License.
