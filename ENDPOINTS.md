# Endpoints

## Open API

No authorization

### [GET] /api/materials/{id}

Full data for specified material.

###### Parameters:

None

| Method | Path                  | Parameters                                                              | Description                                                                      |
|--------|-----------------------|-------------------------------------------------------------------------|----------------------------------------------------------------------------------|
| GET    | `/api/materials`      | - `search` : optional, string, min: 3 <br />- `page` : optional, number | Index published materials <br> Order by `published_at` desc. 15 results per page |
| GET    | `/api/materials/{id}` |                                                                         | Full data for specified material.                                                |
