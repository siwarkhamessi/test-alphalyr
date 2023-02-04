## Laravel User and Group Management API
This is a REST API built with Laravel 8 for managing Users and Groups.

### Prerequisites
- PHP >= 7.4.0
- Laravel >= 8.0
- Composer
- SQL database (MySQL, PostgreSQL, SQLite, etc.)

### Details
- GET /users - retrieves a list of all users.
- POST /users - creates a new user.
- GET /users/{id} - retrieves a user by ID.
- PUT /users/{id} - updates a user by ID.
- POST /group/users/ - creates a user and associates it with a group.
- GET /users/check/{id} - checks if a user exists and is active.
- POST /users/group - adds a list of users to a group.
- Group Endpoints
- GET /groups - retrieves a list of all groups.
- POST /groups - creates a new group.
- GET /groups/{id} - retrieves a group by ID.
- PUT /groups/{id} - updates a group by ID.

