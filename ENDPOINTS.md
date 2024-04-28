# Endpoints

## Open API

No authorization

| Method | Path                  | Parameters                                                                                                      | Description                                                                      |
|--------|-----------------------|-----------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------|
| GET    | `/api/materials`      | - `search` : optional, string, min: 3 <br />- `page` : optional, number <br> -`tags` : optional, array, tag ids | Index published materials <br> Order by `published_at` desc. 15 results per page |
| GET    | `/api/materials/{id}` |                                                                                                                 | Full data for specified material.                                                |
| GET    | `/api/taxonomies`     |                                                                                                                 | List all taxonomies in the project                                               |
| GET    | `/api/sliders`        |                                                                                                                 | Lists all current slides for home page                                           
