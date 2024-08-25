# API-Laravel

## Information
This API is just for training and learning about Laravel.  
All of this is documented in OpenAPI (located in the root).

## Methods

### GET
- List all favorite music

### POST
- Create a new favorite music

### PUT
- Update an existing music

## To test, it is necessary to create the table

You can use `php artisan migrate` or:

<details>
<summary>MySQL Query</summary>

```sql 
CREATE TABLE `favorite_music` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `artist` VARCHAR(255) NOT NULL,
    `tier` INT NOT NULL
);
```
</details>


### ⚠️Ensure your testing environment is configured in the `.env` file.