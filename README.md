# photo-gallery

This is a RESTful api created in php for a Photo Gallery app.

I have developed this api using XAMPP Apache server and this files were inside htdocs folder in XAMPP.
The SQL file for table structure and data in also added.

## Api endpoints

### Login

__POST__ `/api/login` Login user.

### User

__GET__ `/api/users` Read all users

__GET__ `/api/users/{user_id}` Read one user having id=*user_id*

__GET__ `/api/users/{username}` Read one user having username=*username*

__POST__ `/api/users/create` Create user (Register User)

__POST__ `/api/users/delete/{user_id}` Delete user having id=*user_id*

__POST__ `/api/users/update/{user_id}` Update user having id=*user_id*


### Album

__GET__ `/api/albums` Read all albums

__GET__ `/api/albums/{album_id}` Read one album having id=*album_id*

__GET__ `/api/albums/user/{username}` Read one album having username=*username*

__POST__ `/api/albums/create` Create Album (User id is required)

__POST__ `/api/albums/delete/{album_id}` Delete Album having id=*album_id*

__POST__ `/api/albums/update/{album_id}` Update Album having id=*album_id*

### Photo

__GET__ `/api/photos/{photo_id}` Read one photo having id=*photo_id*

__POST__ `/api/photos/create` Create Photo (Album id is required)

__POST__ `/api/photos/delete/{photo_id}` Delete Photo having id=*photo_id*

## Authentication

User Authentication is Json Web Token based. For API endpoints requiring authorization the `api/login` call must be made first with proper credentials. A Token is then generated. All further requests must contain __authorization__ header with the token.



