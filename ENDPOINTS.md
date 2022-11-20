# Endpoints

## Open API

No authorization

### [GET] /api/materials

Index published materials

##### Order:

`published_at` desc

##### Pagination:

15 items per page

###### Parameters:

- `search` : optional, string, min: 3
- `page` : optional, number

### [GET] /api/materials/{id}

Full data for specified material.

###### Parameters:

None
