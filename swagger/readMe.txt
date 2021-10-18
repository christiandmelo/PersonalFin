To run the swagger with docker, use the command bellow

1 - To download docker image
docker pull swaggerapi/swagger-ui

2 - To run docker image
    - Obs: this command was created to be runned into this folder
        (cd C:\xampp\htdocs\PersonalFin\api\swagger)
    Windows cmd
    docker run -p 7020:8080 -e SWAGGER_JSON=/tmp/openapi.json -v %cd%:/tmp swaggerapi/swagger-ui
    Windows PowerShell
    docker run -p 7020:8080 -e SWAGGER_JSON=/tmp/openapi.json -v ${PWD}:/tmp swaggerapi/swagger-ui
    Linux
    docker run -p 7020:8080 -e SWAGGER_JSON=/tmp/openapi.json -v $(pwd):/tmp swaggerapi/swagger-ui

3 - To open in a browser
localhost:7020